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
        static::saved(function () {
            Cache::forget('semua_kategori');
            Cache::forget('katalog_kursus_publish');
        });

        static::deleted(function () {
            Cache::forget('semua_kategori');
            Cache::forget('katalog_kursus_publish');
        });
    }

    public function kursus()
    {
        return $this->hasMany(Kursus::class, 'kategori_id', 'id');
    }
}
