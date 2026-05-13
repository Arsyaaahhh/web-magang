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
    Schema::table('surats', function (Blueprint $table) {
        // Menambahkan kolom status. 
        // Ubah 'file' dengan nama kolom terakhir yang ada di tabel surats Mas Ryan saat ini.
        $table->enum('status', ['aktif', 'nonaktif'])->default('aktif')->after('file');
    });
}

public function down()
{
    Schema::table('surats', function (Blueprint $table) {
        // Menghapus kolom jika di-rollback (dibatalkan)
        $table->dropColumn('status');
    });
}
};
