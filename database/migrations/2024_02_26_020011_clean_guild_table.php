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
        Schema::rename('guilds', 'guild');
        Schema::table('guild', function (Blueprint $table) {
            $table->string('description');
            $table->foreignIdFor(Kingdom::class);
        });
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
