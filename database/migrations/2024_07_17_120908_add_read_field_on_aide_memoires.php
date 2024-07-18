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
        Schema::table('aide_memoires', function (Blueprint $table) {
            $table->boolean('status')->default(false);
        });

        Schema::table('demande_parole_reunion', function (Blueprint $table) {
            $table->boolean('status')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aide_memoires', function (Blueprint $table) {
            //
        });
    }
};
