<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class HargaSampah extends Model
    {
        protected $table = 'harga_sampah';

        protected $primaryKey = 'id_harga';

        protected $fillable = [
        'id_jenis_sampah',
        'id_pengguna_admin',
        'harga_per_kg',
        'tanggal_berlaku',
        'status',
        ];

        public function jenisSampah()
        {
            return $this->belongsTo(
                JenisSampah::class,
                'id_jenis_sampah',
                'id_jenis_sampah'
            );
        }
    }