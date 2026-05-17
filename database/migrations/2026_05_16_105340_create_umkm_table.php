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
    Schema::create('umkm', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('kelurahan_id')->nullable();
        
        $table->integer('total_umkm')->nullable();
        $table->integer('umkm_binaan')->nullable();
        
        $table->integer('sertifikasi_halal')->nullable();
        $table->integer('sertifikasi_merek')->nullable();
        $table->integer('nib')->nullable();
        $table->integer('pirt')->nullable();
        $table->integer('peken')->nullable();
        $table->integer('padat_karya')->nullable();
        $table->string('kategori')->nullable();
        
        $table->timestamps();

        $table->foreign('kelurahan_id')->references('ID_KELURAHAN')->on('kelurahan')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('umkm');
}
};
