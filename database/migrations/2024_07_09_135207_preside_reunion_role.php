<?php

use App\Models\Role;
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
        Schema::create('preside_reunion_role', function (Blueprint $table) {

            $table->string('reunion_id', 100);
            $table->foreign('reunion_id')->references('id')->on('reunions')->onDelete('cascade');

            $table->foreignIdFor(Role::class)->constrained()->cascadeOnDelete();

            $table->primary(['reunion_id','role_id']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preside_reunion_role');
    }
};
