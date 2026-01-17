<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('moderation_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained('users')->onDelete('cascade');
            $table->string('type'); // deletion, report, user_role
            $table->foreignId('target_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('item_type')->nullable(); // Creation, Comment, etc.
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('report_id')->nullable();
            $table->text('reason')->nullable();
            $table->json('metadata')->nullable(); // Données additionnelles
            $table->timestamps();

            $table->index(['staff_id', 'created_at']);
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moderation_logs');
    }
};
