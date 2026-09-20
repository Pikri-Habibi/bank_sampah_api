<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('setoran', function (Blueprint $table) {
        $table->id('id_setoran');
        $table->foreignId('id_pengguna_nasabah')->constrained('nasabah', 'id_pengguna_nasabah')->onDelete('cascade');
        $table->foreignId('id_pengguna_petugas')->constrained('petugas', 'id_pengguna_petugas')->onDelete('cascade');
        $table->foreignId('id_harga')->constrained('harga_sampah', 'id_harga')->onDelete('cascade');
        $table->date('tgl_setoran');
        $table->string('status');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('setoran');
}
};
