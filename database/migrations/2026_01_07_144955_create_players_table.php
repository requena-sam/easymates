<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('pseudo');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('game_name'); // Valorant, Rocket League, etc.
            $table->string('player_number')->nullable(); // #01, #02, etc.
            $table->text('description')->nullable();
            $table->string('profile_picture_uuid')->nullable();
            $table->string('role')->nullable(); // Duelist, IGL, Striker, etc.

            // Réseaux sociaux
            $table->string('twitch')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();

            // Statut streaming
            $table->boolean('is_streaming')->default(false);
            $table->integer('viewer_count')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
