<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    protected $table = 'nasabah';
    protected $primaryKey = 'id_pengguna_nasabah';

    protected $guarded = [];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke tabel Penarikan
    public function penarikan()
    {
        return $this->hasMany(Penarikan::class, 'id_pengguna_nasabah');
    }

    // Relasi ke tabel Setoran
    public function setoran()
    {
        return $this->hasMany(Setoran::class, 'id_pengguna_nasabah');
    }
}
