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
        Schema::table('koperasis', function (Blueprint $table) {
            $table->enum('status_rat', ['YA', 'TIDAK'])->default('TIDAK')->after('ID_KELURAHAN');
            $table->enum('status_lpj', ['LENGKAP', 'TIDAK LENGKAP'])->default('TIDAK LENGKAP')->after('status_rat');
            $table->integer('total_pengawasan')->default(0)->after('status_lpj');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('koperasis', function (Blueprint $table) {
            $table->dropColumn(['status_rat', 'status_lpj', 'total_pengawasan']);
        });
    }
};
