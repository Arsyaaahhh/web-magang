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
        Schema::create('toko_kelontong', function (Blueprint $table) {
            // id INT AUTO_INCREMENT PRIMARY KEY
            $table->id(); 

            // kelurahan_id INT
            // Pastikan tipe datanya sama dengan kolom ID_KELURAHAN di tabel kelurahan
            $table->unsignedBigInteger('kelurahan_id')->nullable();

            // total_toko INT
            $table->integer('total_toko')->nullable()->default(0);

            // peken INT
            $table->integer('peken')->nullable()->default(0);

            // created_at & updated_at TIMESTAMP
            $table->timestamps(); 

            // FOREIGN KEY
            $table->foreign('kelurahan_id')
                  ->references('ID_KELURAHAN')
                  ->on('kelurahan')
                  ->onDelete('set null'); // Atur menjadi 'cascade' jika ingin data ikut terhapus saat kelurahan dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toko_kelontong');
    }
};