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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();

            // DATA SURAT
            $table->string('nomor');                 // nomor surat
            $table->string('judul');                 // judul surat
            $table->enum('jenis', ['SK','SP','SOP']); // jenis surat
            $table->year('tahun');                  // tahun surat
            $table->string('file');                 // file pdf
            $table->string('bidang');               // sekretariat, dll

            $table->timestamps();                  // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};