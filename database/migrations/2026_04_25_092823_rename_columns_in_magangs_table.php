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
        Schema::table('magangs', function (Blueprint $table) {
            $table->renameColumn('tanggal_mulai', 'awal_pelaksanaan');
            $table->renameColumn('tanggal_selesai', 'akhir_pelaksanaan');
            $table->string('durasi')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('magangs', function (Blueprint $table) {
            $table->renameColumn('awal_pelaksanaan', 'tanggal_mulai');
            $table->renameColumn('akhir_pelaksanaan', 'tanggal_selesai');
            $table->integer('durasi')->change();
        });
    }
};
