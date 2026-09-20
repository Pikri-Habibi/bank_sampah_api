<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_pengguna_admin';

    protected $guarded = [];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke tabel Harga Sampah
    public function hargaSampah()
    {
        return $this->hasMany(HargaSampah::class, 'id_pengguna_admin');
    }
}
