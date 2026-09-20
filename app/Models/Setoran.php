<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    protected $table = 'setoran';
    protected $primaryKey = 'id_setoran';

    protected $guarded = [];

    // Relasi ke tabel Nasabah
    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'id_pengguna_nasabah');
    }

    // Relasi ke tabel Petugas
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_pengguna_petugas');
    }

    // Relasi ke tabel Detail Setoran
    public function detailSetoran()
    {
        return $this->hasMany(DetailSetoran::class, 'id_setoran');
    }
}
