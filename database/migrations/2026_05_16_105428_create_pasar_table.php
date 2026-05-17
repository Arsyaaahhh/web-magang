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
        $table->id();
        $table->string('nama_pasar');
        $table->text('alamat')->nullable();
        $table->unsignedBigInteger('kelurahan_id')->nullable();
        
        $table->integer('jumlah_pedagang')->nullable();
        $table->integer('jumlah_stan')->nullable();
        $table->integer('stan_belum_terisi')->nullable();
        $table->integer('luas')->nullable();
        $table->integer('peken')->nullable();
        $table->integer('kapasitas')->nullable();
        
        $table->decimal('latitude', 10, 8)->nullable();
        $table->decimal('longitude', 11, 8)->nullable();
        
        $table->string('dokumenpasar')->nullable();
        $table->string('foto')->nullable();
        
        $table->timestamps();

        $table->foreign('kelurahan_id')->references('ID_KELURAHAN')->on('kelurahan')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('pasar');
}
};
