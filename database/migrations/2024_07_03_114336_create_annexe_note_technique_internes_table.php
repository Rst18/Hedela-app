<?php

use App\Models\NoteTechniqueInterne;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('annexe_note_technique_internes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->mediumText('path');   
            $table->foreignIdFor(NoteTechniqueInterne::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annexe_note_technique_internes');
    }
};
