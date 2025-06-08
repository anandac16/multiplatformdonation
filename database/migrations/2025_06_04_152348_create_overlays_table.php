<?php

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
        Schema::create('overlays', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            
            // Milestone
            $table->string('milestone_title')->nullable();
            $table->integer('milestone_target')->nullable();
            $table->string('milestone_bg_color')->nullable();
            $table->string('milestone_text_color')->nullable();

            // Leaderboard
            $table->string('leaderboard_title')->nullable();
            $table->string('leaderboard_range')->nullable();
            $table->string('leaderboard_bg_color')->nullable();
            $table->string('leaderboard_text_color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overlays');
    }
};
