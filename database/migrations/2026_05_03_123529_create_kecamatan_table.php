<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            // Menggunakan ID_KECAMATAN sebagai Primary Key sesuai SQL Anda
            $table->id('ID_KECAMATAN'); 
            $table->string('NM_KECAMATAN', 100);
            // Tambahkan timestamps jika ingin sinkron dengan standar Laravel
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kecamatan');
    }
};