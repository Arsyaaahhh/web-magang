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
        Schema::table('data_pembinaan', function (Blueprint $table) {
            if (!Schema::hasColumn('data_pembinaan', 'nama_usaha')) {
                $table->string('nama_usaha')->after('id');
            }
            if (!Schema::hasColumn('data_pembinaan', 'jenis')) {
                $table->string('jenis')->after('nama_usaha');
            }
            if (!Schema::hasColumn('data_pembinaan', 'sub_jenis')) {
                $table->string('sub_jenis')->nullable()->after('jenis');
            }
            if (!Schema::hasColumn('data_pembinaan', 'alamat')) {
                $table->string('alamat')->nullable()->after('sub_jenis');
            }
            if (!Schema::hasColumn('data_pembinaan', 'tahun')) {
                $table->year('tahun')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('data_pembinaan', 'keterangan')) {
                $table->text('keterangan')->nullable()->after('tahun');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_pembinaan', function (Blueprint $table) {
            $columns = ['nama_usaha', 'jenis', 'sub_jenis', 'alamat', 'tahun', 'keterangan'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('data_pembinaan', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
