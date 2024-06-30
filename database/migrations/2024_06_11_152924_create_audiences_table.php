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
        Schema::create('audiences', function (Blueprint $table) {
            
            $table->id();
            $table->mediumText('name');
            $table->mediumText('fonction');
            $table->string('phone', 100);
            $table->string('piece', 100);
            $table->string('email', 100)->nullable();
            $table->text('motif');
            $table->date('date_proposition');
            $table->unsignedBigInteger('user_requested');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->integer('status')->default(1);
            $table->integer('audience_from')->nullable();
            $table->boolean('interne')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audiences');
    }
};
