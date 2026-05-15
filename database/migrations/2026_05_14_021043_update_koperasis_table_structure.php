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
        Schema::table('koperasis', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | HAPUS KOLOM LAMA
            |--------------------------------------------------------------------------
            */

            $table->dropColumn([
                'status',
                'status_mitra',
                'jenis_mitra',
                'status_lpj'
            ]);

            /*
            |--------------------------------------------------------------------------
            | UBAH KOLOM YANG SUDAH ADA MENJADI INTEGER
            |--------------------------------------------------------------------------
            */

            $table->integer('jumlah')->nullable()->change();

            $table->integer('padat_karya')->nullable()->change();

            $table->integer('pelaksanaan_rat')->nullable()->change();

            /*
            |--------------------------------------------------------------------------
            | TAMBAH KOLOM INTEGER BARU
            |--------------------------------------------------------------------------
            */

            $table->integer('aktif')->nullable()->after('jumlah');

            $table->integer('tidak_aktif')->nullable()->after('aktif');

            $table->integer('bermitra')->nullable()->after('tidak_aktif');

            $table->integer('mitra_perbankan')->nullable()->after('bermitra');

            $table->integer('lpj_lengkap')->nullable()->after('padat_karya');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('koperasis', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | HAPUS KOLOM BARU
            |--------------------------------------------------------------------------
            */

            $table->dropColumn([
                'aktif',
                'tidak_aktif',
                'bermitra',
                'mitra_perbankan',
                'lpj_lengkap'
            ]);
        });
    }
};