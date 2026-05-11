<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tdgs', function (Blueprint $table) {
            // Tambahkan nullable() agar data lama yang belum punya kecamatan tidak error
            $table->string('kecamatan')->nullable(); 
        });
    }

    public function down(): void
    {
        Schema::table('tdgs', function (Blueprint $table) {
            $table->dropColumn('kecamatan');
        });
    }
};