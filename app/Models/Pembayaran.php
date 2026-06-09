<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'user_id',
        'kursus_id',
        'jumlah',
        'bukti',
        'status',
        'catatan_admin',
        'expired_at',
        'verified_by',
        'verified_at',
        'rejected_at'
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'verified_at' => 'datetime',
        'rejected_at' => 'datetime',
        'jumlah' => 'float'
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id', 'id');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by', 'id');
    }

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class, 'pembayaran_id', 'id');
    }
}
