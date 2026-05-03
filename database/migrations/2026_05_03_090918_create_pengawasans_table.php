<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengawasans', function (Blueprint $table) {
            $table->id();
            // Dropdown pilihan (Toko Swalayan / Gudang Minuman Beralkohol)
            $table->string('jenis_pengawasan'); 
            $table->integer('tahun');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengawasans');
    }
};