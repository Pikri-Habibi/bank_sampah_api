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
    Schema::create('harga_sampah', function (Blueprint $table) {
        $table->id('id_harga');

        $table->foreignId('id_jenis_sampah')
            ->constrained('jenis_sampah', 'id_jenis_sampah')
            ->onDelete('cascade');

        $table->unsignedBigInteger('id_pengguna_admin')->nullable();

        $table->decimal('harga_per_kg', 12, 2);

        $table->date('tanggal_berlaku');

        $table->boolean('status')->default(true);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_sampah');
    }
};
