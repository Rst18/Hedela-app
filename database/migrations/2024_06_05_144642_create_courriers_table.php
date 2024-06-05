<?php

use App\Models\Service;
use App\Models\TypeCourrier;
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
        Schema::create('courriers', function (Blueprint $table) {
            $table->id();
            $table->string('number', 100);
            $table->string('sender', 100);
            $table->string('email', 100);
            $table->string('phone', 100);
            $table->string('objet', 100);
            $table->string('letter_numer', 100);
            $table->integer('annexes')->default(0);
            $table->mediumText('letter_file');
            $table->foreignIdFor(Service::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(TypeCourrier::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courriers');
    }
};
