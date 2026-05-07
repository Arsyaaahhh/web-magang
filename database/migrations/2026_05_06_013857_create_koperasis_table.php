<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('koperasis', function (Blueprint $table) {
            $table->id(); // sama dengan BIGINT UNSIGNED AUTO_INCREMENT

            $table->integer('jumlah');
            $table->enum('status', ['aktif', 'tidak aktif']);
            $table->year('tahun')->nullable();
            $table->enum('status_mitra', ['bermitra', 'belum']);
            $table->enum('jenis_mitra', ['perbankan', 'non']);

            $table->unsignedBigInteger('ID_KECAMATAN');
            $table->unsignedBigInteger('ID_KELURAHAN');

            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('koperasis');
    }
};