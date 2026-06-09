<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Modul extends Model
{
    protected $table = 'modul';

    protected $fillable = [
        'kursus_id',
        'judul',
        'urutan',
        'file',    
    ];

    protected static function booted()
    {
        static::saved(function ($modul) {
            if ($modul->kursus_id) {
                Cache::forget("kursus_detail_{$modul->kursus_id}");
            }
        });

        static::deleted(function ($modul) {
            if ($modul->kursus_id) {
                Cache::forget("kursus_detail_{$modul->kursus_id}");
            }
        });
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id', 'id');
    }

    public function materi()
    {
        return $this->hasMany(Materi::class, 'modul_id', 'id');
    }
}
