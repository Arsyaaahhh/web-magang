<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('swk', function (Blueprint $table) {
            $table->integer('luas')->nullable(); 
        });
    }

    public function down(): void
    {
        Schema::table('swk', function (Blueprint $table) {
            $table->dropColumn('luas');
        });
    }
};