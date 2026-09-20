<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penarikan', function (Blueprint $table) {
            if (!Schema::hasColumn('penarikan', 'kode_penarikan')) {
                $table->string('kode_penarikan')->nullable()->after('id_pengguna_nasabah');
            }

            if (!Schema::hasColumn('penarikan', 'status')) {
                $table->string('status')->default('pending')->after('tgl_pengajuan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('penarikan', function (Blueprint $table) {
            if (Schema::hasColumn('penarikan', 'kode_penarikan')) {
                $table->dropColumn('kode_penarikan');
            }

            if (Schema::hasColumn('penarikan', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
