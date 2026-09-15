<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSampah extends Model
{
    protected $table = 'jenis_sampah';

    protected $primaryKey = 'id_jenis_sampah';

    protected $fillable = [
        'nama_sampah',
        'status',
    ];

    public function harga()
    {
        return $this->hasMany(HargaSampah::class, 'id_jenis_sampah', 'id_jenis_sampah');
    }
}