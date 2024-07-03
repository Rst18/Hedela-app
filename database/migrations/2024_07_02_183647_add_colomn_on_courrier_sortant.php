<?php

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
        if (!Schema::hasColumn('courrier_sortants', 'accuse_reception_file'))
        {
            Schema::table('courrier_sortants', function (Blueprint $table) {
                $table->mediumText('accuse_reception_file')->nullable();
                $table->foreignIdFor(Courrier::class)->nullable()->constrained()->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courrier_sortants', function (Blueprint $table) {
            $table->dropColumn('accuse_reception_file');
            $table->dropColumn('courrier_id');
        });
    }
};
