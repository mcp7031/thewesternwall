<?php

use App\Models\Product;
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
            Schema::create('images', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Product::class)->constrained()->restrictOnDelete();
                $table->tinyInteger('next_image')->default(0);  //not currently used, could be a sort field
                $table->boolean('featured')->default(false);
                $table->string('path');
                $table->timestamps();
            });
        }

        /**
     * Reverse the migrations.
     */
        public function down(): void
        {
            Schema::dropIfExists('images');
        }
    };
