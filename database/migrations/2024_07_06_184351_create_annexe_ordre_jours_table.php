<?php

use App\Models\OrdreJour;
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
        Schema::create('annexe_ordre_jours', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('filePath', 100);
            $table->foreignIdFor(OrdreJour::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annexe_ordre_jours');
    }
};
