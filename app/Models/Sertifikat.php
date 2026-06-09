<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $table = 'sertifikat';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'kursus_id',
        'nomor_sertifikat',
        'file_sertifikat',
        'tanggal_terbit'
    ];

    protected $casts = [
        'tanggal_terbit' => 'datetime',
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id', 'id');
    }
}
