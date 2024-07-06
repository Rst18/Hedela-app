<?php

use App\Models\Reunion;
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
        Schema::create('ordre_jours', function (Blueprint $table) {
            $table->id();
            $table->mediumText('name');
            $table->mediumText('description')->nullable();
            $table->foreignIdFor(Reunion::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordre_jours');
    }
};
