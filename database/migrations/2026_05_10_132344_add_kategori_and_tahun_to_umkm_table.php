<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('id'); // Sesuaikan posisi 'after' jika perlu
            $table->integer('tahun')->nullable()->after('kategori');
        });
    }

    public function down(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'tahun']);
        });
    }
};