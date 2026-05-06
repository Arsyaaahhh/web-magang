<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pegawai_rekap', function (Blueprint $table) {
            // Menaruh kolom bidang setelah kolom pendidikan
            $table->string('bidang')->nullable()->after('pendidikan'); 
        });
    }

    public function down(): void
    {
        Schema::table('pegawai_rekap', function (Blueprint $table) {
            $table->dropColumn('bidang');
        });
    }
};