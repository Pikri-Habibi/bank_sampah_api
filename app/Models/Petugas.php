<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_pengguna_petugas';

    protected $guarded = [];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke tabel Setoran
    public function setoran()
    {
        return $this->hasMany(Setoran::class, 'id_pengguna_petugas');
    }
}
