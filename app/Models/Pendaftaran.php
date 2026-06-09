<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'user_id',
        'kursus_id',
        'pembayaran_id',
        'status'
    ];

    protected static function booted()
    {
        static::saved(function ($pendaftaran) {
            Cache::forget("kursus_detail_{$pendaftaran->kursus_id}");
        });

        static::deleted(function ($pendaftaran) {
            Cache::forget("kursus_detail_{$pendaftaran->kursus_id}");
        });
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id', 'id');
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id', 'id');
    }
}
