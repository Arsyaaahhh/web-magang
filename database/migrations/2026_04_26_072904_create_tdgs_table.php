<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tdgs', function (Blueprint $table) {
            $table->id();

            // ================= DATA USAHA =================
            $table->string('nama_usaha');
            $table->string('pemilik');
            $table->text('alamat');

            // ================= DATA GUDANG =================
            $table->string('nama_gudang')->nullable();
            $table->text('lokasi_gudang')->nullable();

            // ================= DATA TDG =================
            $table->string('nomor_tdg')->unique();
            $table->date('tanggal_terbit');

            // ================= STATUS =================
            $table->enum('status', ['aktif','nonaktif'])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tdgs');
    }
};
