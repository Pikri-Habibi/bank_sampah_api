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
        Schema::table('penarikan', function (Blueprint $table) {

            $table->unsignedBigInteger('id_petugas')
                ->nullable()
                ->after('status');

            $table->timestamp('tanggal_verifikasi')
                ->nullable()
                ->after('id_petugas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penarikan', function (Blueprint $table) {

            $table->dropColumn([
                'id_petugas',
                'tanggal_verifikasi'
            ]);

        });
    }
};