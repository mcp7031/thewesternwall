<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Longman\TelegramBot\Entities\Message;

return new class extends Migration
    {
        /**
     * Run the migrations.
     */
        public function up(): void
        {
            Schema::create('TelegramPosts', function (Blueprint $table) {
                $table->unsignedBigInteger('id')->references('id')->on('bot_message');
                $table->foreignId('aoc_id')->constrained();
                $table->foreignId('user_id')->constrained();
                $table->string('title')->nullable();
                $table->text('excerpt')->nullable();
                $table->text('body');
                $table->string('link')->nullable();
                $table->timestamp('published_at')->nullable();
                $table->string('slug')->nullable();
                $table->string('hashtag')->nullable();
                $table->timestamps();
            });
        }

        /**
     * Reverse the migrations.
     */
        public function down(): void
        {
            Schema::dropIfExists('TelegramPosts');
        }
    };
