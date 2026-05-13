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
        Schema::table('kkmp', function (Blueprint $table) {
            $table->string('nama_kkmp');
            $table->string('no_badan_hukum');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kkmp', function (Blueprint $table) {
            $table->dropColumn(['nama_kkmp', 'no_badan_hukum']);
        });
    }
};