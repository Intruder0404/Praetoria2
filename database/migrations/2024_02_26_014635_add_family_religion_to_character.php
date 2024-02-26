<?php

use App\Models\Family\Family;
use App\Models\Religion\Religion;
use App\Models\User\Rank;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('character', function (Blueprint $table) {
            $table->foreignIdFor(Family::class);
            $table->foreignIdFor(Religion::class);
            $table->foreignIdFor(Rank::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('character', function (Blueprint $table) {
            $table->dropColumn(['family_id', 'religion_id', 'rank_id']);
        });
    }
};
