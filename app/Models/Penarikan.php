<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    protected $table = 'penarikan';
    protected $primaryKey = 'id_penarikan';

    protected $guarded = [];

    protected $casts = [
        'nominal' => 'decimal:2',
        'tgl_pengajuan' => 'date',
        'tanggal_verifikasi' => 'datetime',
    ];

    // Relasi ke tabel Nasabah
    public function nasabah()
    {
        return $this->belongsTo(
            Nasabah::class,
            'id_pengguna_nasabah'
        );
    }

    // Relasi ke Petugas yang melakukan verifikasi
    public function petugas()
    {
        return $this->belongsTo(
            User::class,
            'id_petugas'
        );
    }
}