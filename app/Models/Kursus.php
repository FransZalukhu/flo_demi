<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Cache;

class Kursus extends Model
{
    use SoftDeletes;

    protected $table = 'kursus';

    protected $fillable = [
        'judul',
        'kategori_id',
        'mentor_id',
        'deskripsi',
        'harga',
        'kuota',
        'status',
        'gambar'
    ];

    protected static function booted()
    {
        static::saved(function ($kursus) {
            static::clearCache($kursus);
        });

        static::deleted(function ($kursus) {
            static::clearCache($kursus);
        });
    }

    protected static function clearCache($kursus)
    {
        Cache::forget('katalog_kursus_publish');
        Cache::forget('stats_total_course');
        Cache::forget('chart_course_growth');
        Cache::forget("kursus_detail_{$kursus->id}");
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }

    public function modul()
    {
        return $this->hasMany(Modul::class, 'kursus_id', 'id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'kursus_id', 'id');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'kursus_id', 'id');
    }

    /**
     * Get the number of registered students (active/pending).
     */
    public function getTerdaftarCountAttribute()
    {
        if (array_key_exists('terdaftar_count', $this->attributes)) {
            return $this->attributes['terdaftar_count'];
        }

        return $this->pendaftaran()
            ->whereIn('status', ['menunggu_pembayaran', 'menunggu_verifikasi', 'aktif', 'selesai'])
            ->where(function ($query) {
                $query->whereHas('pembayaran', function ($q) {
                    $q->where('expired_at', '>', now())
                      ->orWhere('status', 'success');
                })->orWhereNull('pembayaran_id');
            })
            ->count();
    }

    /**
     * Get the remaining quota.
     * Returns null if quota is unlimited (0).
     */
    public function getSisaKuotaAttribute()
    {
        if ($this->kuota == 0) {
            return null;
        }
        return max(0, $this->kuota - $this->terdaftar_count);
    }

    /**
     * Check if the course is full.
     */
    public function isFull()
    {
        // If quota is 0, it means unlimited.
        if ($this->kuota == 0) {
            return false;
        }
        return $this->terdaftar_count >= $this->kuota;
    }
}