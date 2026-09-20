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
        Schema::table('setoran', function (Blueprint $table) {
            $table->dropForeign(['id_harga']);
            $table->dropColumn('id_harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setoran', function (Blueprint $table) {
            $table->foreignId('id_harga')
                ->nullable()
                ->constrained('harga_sampah', 'id_harga')
                ->onDelete('cascade');
        });
    }
};