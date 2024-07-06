<?php

use App\Models\User;
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
        Schema::create('reunions', function (Blueprint $table) {
            $table->string('id',100)->primary();
            // $table->string('code', 100);
            $table->mediumText('description')->nullable();
            $table->mediumText('lien_zoom')->nullable();
            $table->mediumText('lien_youtube')->nullable();
            $table->timestamp('date_debut')->nullable(); 
            $table->timestamp('date_fin')->nullable(); 
            $table->boolean('status')->default(false);
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reunions');
    }
};
