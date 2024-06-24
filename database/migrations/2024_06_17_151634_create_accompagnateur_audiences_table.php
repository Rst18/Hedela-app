<?php

use App\Models\Audience;
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
        Schema::create('accompagnateur_audiences', function (Blueprint $table) {
            $table->id();
            $table->mediumText('name');
            $table->mediumText('email')->nullable();
            $table->mediumText('phone')->nullable();
            $table->foreignIdFor(Audience::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accompagnateur_audiences');
    }
};
