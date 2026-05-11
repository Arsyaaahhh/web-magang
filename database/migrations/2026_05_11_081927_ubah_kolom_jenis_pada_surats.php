<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Mengubah kolom jenis menjadi VARCHAR(255) agar bisa menampung teks apa saja (ZI, dll)
        DB::statement("ALTER TABLE surats MODIFY COLUMN jenis VARCHAR(255)");
    }

    public function down(): void
    {
        // Mengembalikan ke ENUM jika di-rollback (Opsional)
        DB::statement("ALTER TABLE surats MODIFY COLUMN jenis ENUM('SK', 'SP', 'SOP')");
    }
};