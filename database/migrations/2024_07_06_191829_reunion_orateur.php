<?php

use App\Models\User;
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
        Schema::create('reuion_orateur', function (Blueprint $table) {
            // $table->string('post_id')->primary();
            // $table->string('tag_id')->primary();
            // $table->timestamps();

            // // Optional: Unique index for many-to-many relationship
            // $table->unique(['post_id', 'tag_id']);


            $table->foreignIdFor(Reunion::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->primary(['reunion_id','user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reuion_orateur');
    }
};
