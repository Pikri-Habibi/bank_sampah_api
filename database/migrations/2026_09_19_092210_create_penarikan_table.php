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
    Schema::create('penarikan', function (Blueprint $table) {
        $table->id('id_penarikan');
        $table->foreignId('id_pengguna_nasabah')->constrained('nasabah', 'id_pengguna_nasabah')->onDelete('cascade');
        $table->decimal('nominal', 12, 2);
        $table->date('tgl_pengajuan');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('penarikan');
}
};
