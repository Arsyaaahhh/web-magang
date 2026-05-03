<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelurahan', function (Blueprint $table) {
            // Primary Key sesuai SQL Anda
            $table->id('ID_KELURAHAN'); 
            
            // Kolom Foreign Key ke Kecamatan
            $table->unsignedBigInteger('ID_KECAMATAN'); 
            
            $table->string('NM_KELURAHAN', 100);
            $table->timestamps();

            // Definisi Foreign Key
            $table->foreign('ID_KECAMATAN')
                  ->references('ID_KECAMATAN')
                  ->on('kecamatan')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelurahan');
    }
};