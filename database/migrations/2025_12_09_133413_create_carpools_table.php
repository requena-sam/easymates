<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carpools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('departure_country');
            $table->string('departure_address');
            $table->string('arrival_address');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('price_per_person', 8, 2);
            $table->integer('available_spots');
            $table->string('whatsapp')->nullable();
            $table->string('discord')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carpools');
    }
};
