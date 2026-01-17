<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('game_name');
            $table->string('address');
            $table->string('country');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->text('description');
            $table->string('image_uuid')->nullable(); // UUID simple
            $table->string('official_ticketing_link');
            $table->string('secondary_ticketing_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
