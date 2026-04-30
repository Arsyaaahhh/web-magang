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
        Schema::table('magangs', function (Blueprint $table) {
            $table->renameColumn('r2', 'kepemilikan_r2');
        });
    }

    public function down(): void
    {
        Schema::table('magangs', function (Blueprint $table) {
            $table->renameColumn('kepemilikan_r2', 'r2');
        });
    }
};
