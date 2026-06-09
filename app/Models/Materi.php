<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';

    protected $fillable = [
        'modul_id',
        'judul',
        'tipe',
        'url_file',
        'urutan'
    ];

    public function modul()
    {
        return $this->belongsTo(Modul::class, 'modul_id', 'id');
    }

    public function progres()
    {
        return $this->hasMany(ProgresMateri::class, 'materi_id', 'id');
    }
}
