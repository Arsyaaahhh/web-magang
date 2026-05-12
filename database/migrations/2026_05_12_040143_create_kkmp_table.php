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
        Schema::dropIfExists('kkmp');
        Schema::create('kkmp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_KECAMATAN');
            $table->unsignedBigInteger('ID_KELURAHAN');
            $table->year('tahun');
            $table->string('alamat');
            $table->enum('jenis_kkmp', [
                'Gerai/Outlet Sembako (Kios Pangan)',
                'Apotek & Klinik Kelurahan',
                'Unit Jasa Keuangan Mikro',
                'Fasilitas Cold Storage & Logistik',
                'Unit Pemasaran UMKM',
                'Unit Jasa Pemenuhan Gizi (Pemasok SPPG)'
            ]);
            $table->integer('jumlah_anggota');
            $table->decimal('total_omzet', 15, 2);
            $table->timestamps();

            $table->foreign('ID_KECAMATAN')->references('ID_KECAMATAN')->on('kecamatan');
            $table->foreign('ID_KELURAHAN')->references('ID_KELURAHAN')->on('kelurahan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kkmp');
    }
};
