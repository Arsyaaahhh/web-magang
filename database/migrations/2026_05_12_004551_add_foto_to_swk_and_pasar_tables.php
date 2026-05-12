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
        // =========================
        // 1. tambahan swk
        // =========================
        Schema::table('swk', function (Blueprint $table) {
            $table->string('foto', 255)->nullable()->after('id'); // Kamu bisa ganti 'id' dengan nama kolom terakhir yang kamu mau
        });

        // =========================
        // 2. tambahan pasar
        // =========================
        Schema::table('pasar', function (Blueprint $table) {
            $table->string('foto', 255)->nullable()->after('id'); // Sesuaikan juga penempatan kolomnya
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus kolom foto jika dilakukan rollback (php artisan migrate:rollback)
        Schema::table('swk', function (Blueprint $table) {
            $table->dropColumn('foto');
        });

        Schema::table('pasar', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};