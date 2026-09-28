<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penarikan', function (Blueprint $table) {
            $table->string('kode_verifikasi')->nullable()->after('kode_penarikan');
        });

        DB::table('penarikan')
            ->whereNull('kode_verifikasi')
            ->whereNotNull('kode_penarikan')
            ->update(['kode_verifikasi' => DB::raw('kode_penarikan')]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penarikan', function (Blueprint $table) {
            $table->dropColumn('kode_verifikasi');
        });
    }
};
