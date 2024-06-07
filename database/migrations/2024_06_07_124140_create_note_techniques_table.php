<?php

use App\Models\User;
use App\Models\Courrier;
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
        Schema::create('note_techniques', function (Blueprint $table) {
            $table->id();
            $table->mediumText('faits');
            $table->mediumText('analyse');
            $table->mediumText('conclusion');
            $table->mediumText('actions');
            $table->mediumText('objet');
            $table->mediumText('destinataire');
            $table->mediumText('signataire');
            $table->mediumText('copiea');
            $table->integer('type_lettre')->default(1);
            $table->integer('annexes')->default(0);
            $table->longText('lettre');       
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();   
            $table->foreignIdFor(Courrier::class)->constrained()->cascadeOnDelete();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note_techniques');
    }
};
