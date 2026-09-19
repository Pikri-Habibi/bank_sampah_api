<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    protected $table = 'penarikan';
    protected $primaryKey = 'id_penarikan';

    protected $guarded = [];

    // Relasi ke tabel Nasabah
    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'id_pengguna_nasabah');
    }
}
