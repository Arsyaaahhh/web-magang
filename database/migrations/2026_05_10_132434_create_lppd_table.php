<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lppd', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('kelurahan_id')->nullable();
            
            $table->integer('jumlah')->nullable();
            $table->integer('tahun')->nullable();
            
            $table->timestamps();

            // Definisi Foreign Key
            $table->foreign('kelurahan_id')
                  ->references('ID_KELURAHAN')
                  ->on('kelurahan')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lppd');
    }
};