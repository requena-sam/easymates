<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('co_hostings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->json('image_uuids')->nullable(); // Tableau d'UUIDs
            $table->text('author_message')->nullable();
            $table->integer('available_spots');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('address');
            $table->decimal('price_per_person', 10, 2);
            $table->string('listing_link')->nullable();

            // Réseaux sociaux
            $table->string('whatsapp')->nullable();
            $table->string('discord')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('co_hostings');
    }
};
