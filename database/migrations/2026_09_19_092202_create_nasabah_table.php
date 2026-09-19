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
    Schema::create('nasabah', function (Blueprint $table) {
        $table->id('id_pengguna_nasabah');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('nama_lengkap');
        $table->string('no_telepon');
        $table->decimal('saldo', 12, 2)->default(0);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('nasabah');
}
};
