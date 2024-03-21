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
            Schema::create('aocs', function (Blueprint $table) {
                $table->id();
                $table->string('category');
                $table->string('description')->nullable(); //why this is an area of concern
                $table->text('taglist')->nullable();  // comma delimited list of words that might be found in this aoc
                $table->timestamps();
            });
        }

        /**
     * Reverse the migrations.
     */
        public function down(): void
        {
            Schema::dropIfExists('aocs');
        }
    };
