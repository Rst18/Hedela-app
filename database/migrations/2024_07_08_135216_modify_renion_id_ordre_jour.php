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
        Schema::table('ordre_jours', function (Blueprint $table) {

            $table->dropColumn('reunion_id');

        });

        Schema::table('ordre_jours', function (Blueprint $table) {
            $table->string('reunion_id', 100);
            $table->foreign('reunion_id')->references('id')->on('reunions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
