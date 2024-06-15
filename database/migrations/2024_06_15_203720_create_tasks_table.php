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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->mediumText('nom');
            $table->text('description');
            $table->integer('statut')->unsigned()->default(0);
            $table->integer('priorite')->unsigned()->default(0);
            $table->integer('statut_resolution')->unsigned()->default(0);
            $table->timestamp('date_limite')->nullable();      
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
