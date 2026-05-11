<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Cek dan tambahkan kolom rekap HANYA JIKA belum ada
        Schema::table('magangs', function (Blueprint $table) {
            if (!Schema::hasColumn('magangs', 'tahun')) {
                $table->string('tahun')->nullable();
                $table->string('bulan')->nullable();
                $table->integer('jumlah')->nullable();
            }
        });

        // 2. Ubah kolom lama menjadi boleh kosong (nullable)
        Schema::table('magangs', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('nama')->nullable()->change();
            $table->string('asal_univ')->nullable()->change();
            $table->date('awal_pelaksanaan')->nullable()->change();
            $table->date('akhir_pelaksanaan')->nullable()->change();
            $table->string('posisi')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('magangs', function (Blueprint $table) {
            if (Schema::hasColumn('magangs', 'tahun')) {
                $table->dropColumn(['tahun', 'bulan', 'jumlah']);
            }
        });
    }
};