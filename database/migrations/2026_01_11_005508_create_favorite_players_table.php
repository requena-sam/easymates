<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('favorite_players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('player_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Un utilisateur ne peut pas ajouter deux fois le même joueur
            $table->unique(['user_id', 'player_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorite_players');
    }
};
