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
    Schema::create('magangs', function (Blueprint $table) {
        $table->id();

        $table->string('email');
        $table->string('nama');
        $table->string('asal_univ');


        $table->date('awal_pelaksanaan');
        $table->date('akhir_pelaksanaan');

        $table->string('posisi');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magangs');
    }
};
