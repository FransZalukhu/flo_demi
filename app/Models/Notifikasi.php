<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';

    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'judul',
        'pesan',
        'tipe',
        'sudah_dibaca',
        'pendaftaran_id'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id', 'id');
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
