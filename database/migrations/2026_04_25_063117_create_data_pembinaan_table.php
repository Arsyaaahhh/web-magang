<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::create('data_pembinaan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha');
            $table->string('jenis'); // tdg / pengawasan / minol
            $table->string('sub_jenis')->nullable();
            $table->string('alamat')->nullable();
            $table->year('tahun')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pembinaan');
    }
};
