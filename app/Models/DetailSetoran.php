<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSetoran extends Model
{
    protected $table = 'detail_setoran';
    protected $primaryKey = 'id_detail';

    protected $guarded = [];

    // Relasi ke tabel Setoran
    public function setoran()
    {
        return $this->belongsTo(Setoran::class, 'id_setoran');
    }

    // Relasi ke tabel Jenis Sampah
    public function jenisSampah()
    {
        return $this->belongsTo(JenisSampah::class, 'id_jenis_sampah');
    }
}
