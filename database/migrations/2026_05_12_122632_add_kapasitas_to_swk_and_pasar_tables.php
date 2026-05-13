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
        // 1. Tambahan kolom kapasitas untuk tabel swk
        Schema::table('swk', function (Blueprint $table) {
            // Menggunakan nullable() agar tidak error jika tabel sudah berisi data lama
            $table->integer('kapasitas')->nullable()->after('nama_swk'); 
            // Catatan: Ubah 'nama_swk' dengan nama kolom terakhir yang ada di tabel Anda 
            // agar posisi kolom kapasitas rapi. Atau hapus saja ->after(...) jika bebas.
        });

        // 2. Tambahan kolom kapasitas untuk tabel pasar
        Schema::table('pasar', function (Blueprint $table) {
            $table->integer('kapasitas')->nullable()->after('nama_pasar');
            // Sama seperti di atas, sesuaikan 'nama_pasar' dengan kolom Anda.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus kolom jika di-rollback
        Schema::table('swk', function (Blueprint $table) {
            $table->dropColumn('kapasitas');
        });

        Schema::table('pasar', function (Blueprint $table) {
            $table->dropColumn('kapasitas');
        });
    }
};