<?php

use App\Models\Kingdom\Kingdom;
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
        Schema::rename('character', 'characters');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guilds', function (Blueprint $table) {
            //
        });
    }
};
