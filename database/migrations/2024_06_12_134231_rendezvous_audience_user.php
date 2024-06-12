<?php

use App\Models\User;
use App\Models\RendezvousAudience;
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
        Schema::create('rendezvous_audience_user', function (Blueprint $table) {
            $table->foreignIdFor(RendezvousAudience::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->primary(['rendezvous_audience_id','user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendezvous_audience_user');
    }
};
