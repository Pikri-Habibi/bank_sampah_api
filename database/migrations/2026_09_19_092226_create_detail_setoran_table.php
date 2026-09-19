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
    Schema::create('detail_setoran', function (Blueprint $table) {
        $table->id('id_detail');
        $table->foreignId('id_setoran')->constrained('setoran', 'id_setoran')->onDelete('cascade');
        $table->foreignId('id_jenis_sampah')->constrained('jenis_sampah', 'id_jenis_sampah')->onDelete('cascade');
        $table->decimal('total_berat', 8, 2);
        $table->decimal('harga_per_kg', 12, 2);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('detail_setoran');
}
};
