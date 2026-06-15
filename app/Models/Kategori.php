<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'nama'
    ];

    protected static function booted()
    {
        static::saved(function ($kategori) {
            Cache::forget('semua_kategori');
            Cache::forget('katalog_kursus_publish');

            if ($kategori->kursus) {
                foreach ($kategori->kursus as $kursus) {
                    Cache::forget("kursus_detail_{$kursus->id}");
                }
            }
        });

        static::deleted(function ($kategori) {
            Cache::forget('semua_kategori');
            Cache::forget('katalog_kursus_publish');

            if ($kategori->kursus) {
                foreach ($kategori->kursus as $kursus) {
                    Cache::forget("kursus_detail_{$kursus->id}");
                }
            }
        });
    }

    public function kursus()
    {
        return $this->hasMany(Kursus::class, 'kategori_id', 'id');
    }
}
