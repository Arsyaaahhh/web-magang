<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('swk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_swk', 255);
            $table->text('alamat')->nullable();
            
            // Menghubungkan ke ID_KELURAHAN di tabel kelurahan
            $table->unsignedBigInteger('kelurahan_id');

            $table->integer('jumlah_pedagang')->default(0);
            $table->integer('jumlah_stan')->default(0);
            $table->integer('stan_belum_terisi')->default(0);

            $table->timestamps();

            // Foreign Key
            $table->foreign('kelurahan_id')->references('ID_KELURAHAN')->on('kelurahan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('swk');
    }
};