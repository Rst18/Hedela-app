<?php

use App\Models\User;
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
        Schema::create('rendezvous_audiences', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Audience::class)->constrained()->cascadeOnDelete();
            $table->dateTime('date_heure');
            $table->string('lieu', 100)->nullable();
            $table->integer('status')->default(1);
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendezvous_audiences');
    }
};
