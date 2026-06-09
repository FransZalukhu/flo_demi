<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgresMateri extends Model
{
    protected $table = 'progres_materi';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'materi_id',
        'selesai',
        'tanggal_selesai'
    ];

    protected $casts = [
        'tanggal_selesai' => 'datetime',
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id', 'id');
    }
}
