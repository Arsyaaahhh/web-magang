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
        Schema::create('pasar', function (Blueprint $table) {
            // Primary Key
            $table->id(); 
            
            // Nama Pasar
            $table->string('nama_pasar', 255); 

            // Relasi ke tabel Kelurahan (Pastikan tipe data sama dengan ID_KELURAHAN)
            $table->unsignedBigInteger('kelurahan_id')->nullable();

            // Data Stan & Pedagang
            $table->integer('jumlah_pedagang')->nullable()->default(0);
            $table->integer('jumlah_stan')->nullable()->default(0);
            $table->integer('stan_belum_terisi')->nullable()->default(0);

            // created_at & updated_at
            $table->timestamps(); 

            // Membuat Foreign Key
            $table->foreign('kelurahan_id')
                  ->references('ID_KELURAHAN')
                  ->on('kelurahan')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasar');
    }
};