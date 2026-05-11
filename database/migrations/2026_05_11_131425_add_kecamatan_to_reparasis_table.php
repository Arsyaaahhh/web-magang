<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ganti jadi 'metrologi_reparasis'
        Schema::table('metrologi_reparasis', function (Blueprint $table) {
            $table->string('kecamatan')->nullable()->after('tahun'); 
        });
    }

    public function down(): void
    {
        Schema::table('metrologi_reparasis', function (Blueprint $table) {
            $table->dropColumn('kecamatan');
        });
    }
};