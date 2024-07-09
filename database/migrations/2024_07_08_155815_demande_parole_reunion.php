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
        Schema::create('demande_parole_reunion', function (Blueprint $table) {

            $table->string('reunion_id', 100);
            $table->foreign('reunion_id')->references('id')->on('reunions')->onDelete('cascade');

            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();

           $table->boolean('confirmed')->default(false);


            $table->primary(['reunion_id','user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_parole_reunion');
    }
};
