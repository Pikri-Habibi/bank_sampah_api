<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasis';

    protected $fillable = [
        'id_pengguna_nasabah',
        'judul',
        'pesan',
        'tipe',
        'dibaca',
    ];

    public function nasabah()
    {
        return $this->belongsTo(
            Nasabah::class,
            'id_pengguna_nasabah',
            'id_pengguna_nasabah'
        );
    }
}