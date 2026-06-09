<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModulProgress extends Model
{
    protected $table = 'user_modul_progress';

    protected $fillable = [
        'user_id',
        'kursus_id',
        'modul_id',
        'status_modul',
        'status_kursus',
        'selesai_at',
    ];

    protected $casts = [
        'selesai_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }

    public function modul()
    {
        return $this->belongsTo(Modul::class);
    }
}