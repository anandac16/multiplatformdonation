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
        Schema::create('webhook_tokens', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('trakteer_token');
            $table->string('saweria_token');
            $table->string('sociabuzz_token');
            $table->string('tako_token');
            $table->longText('last_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webhook_tokens');
    }
};
