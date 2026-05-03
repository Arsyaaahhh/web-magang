<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke ID_KELURAHAN di tabel kelurahan
            $table->unsignedBigInteger('kelurahan_id'); 

            $table->integer('total_umkm')->default(0);
            $table->integer('umkm_binaan')->default(0);

            $table->integer('sertifikasi_halal')->default(0);
            $table->integer('sertifikasi_merek')->default(0);
            $table->integer('nib')->default(0);
            $table->integer('peken')->default(0);
            $table->integer('padat_karya')->default(0);

            $table->timestamps(); // Ini otomatis membuat created_at dan updated_at

            // Foreign Key
            $table->foreign('kelurahan_id')->references('ID_KELURAHAN')->on('kelurahan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};