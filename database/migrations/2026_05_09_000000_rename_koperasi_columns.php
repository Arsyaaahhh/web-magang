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
            $table->renameColumn('status_rat', 'padat_karya');
            $table->renameColumn('total_pengawasan', 'pelaksanaan_rat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('koperasis', function (Blueprint $table) {
            $table->renameColumn('padat_karya', 'status_rat');
            $table->renameColumn('pelaksanaan_rat', 'total_pengawasan');
        });
    }
};
