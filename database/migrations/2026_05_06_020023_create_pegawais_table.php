<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id(); // BIGINT AUTO_INCREMENT

            $table->integer('jumlah_pegawai');
            $table->enum('status', ['pns', 'non_pns']);
            $table->enum('program', ['diklat', 'bimtek', 'tidak ada']);

            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};