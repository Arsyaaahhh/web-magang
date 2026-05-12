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
        Schema::table('pasar', function (Blueprint $table) {
            // Menambahkan kolom alamat dengan tipe string
            // nullable() digunakan agar data lama yang sudah ada tidak error karena kosong
            $table->string('alamat')->nullable()->after('nama_pasar'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pasar', function (Blueprint $table) {
            // Menghapus kolom alamat jika di-rollback
            $table->dropColumn('alamat');
        });
    }
};