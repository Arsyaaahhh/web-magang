<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pegawai_rekap', function (Blueprint $table) {
            // Menambahkan kolom pangkat_golongan setelah kolom 'status'
            $table->string('pangkat_golongan')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('pegawai_rekap', function (Blueprint $table) {
            $table->dropColumn('pangkat_golongan');
        });
    }
};