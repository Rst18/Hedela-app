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

        Schema::table('note_techniques', function (Blueprint $table) {

            $table->boolean('visible')->default(false);

        });

        Schema::table('commentaire_note_internes', function (Blueprint $table) {

            $table->boolean('visible')->default(false);

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('note_techniques', function (Blueprint $table) {
            $table->dropColumn('visible');
        });


        Schema::table('commentaire_note_internes', function (Blueprint $table) {
            $table->dropColumn('visible');
        });
    }
};
