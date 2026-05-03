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

            // ================= REKAP DATA =================
            $table->integer('tahun')->unique(); // Mencegah input tahun yang sama dua kali
            $table->integer('jumlah');          // Jumlah total TDG di tahun tersebut

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tdgs');
    }
};