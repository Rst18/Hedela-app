<?php

use App\Models\User;
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
        Schema::create('commentaire_note_technique_internes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(NoteTechniqueInterne::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->text('commentaire');
            $table->integer('commentaireParent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaire_note_technique_internes');
    }
};
