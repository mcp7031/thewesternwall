<?php

namespace Database\Seeders;

use App\Models\Aoc;
use App\Models\Images;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductVariants;
use App\Models\Carts;
use App\Models\CartItems;
use Illuminate\Database\Eloquent\Concerns\GuardsAttributes;
use Illuminate\Database\Eloquent;
use Database\Factories\AocFactory;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Laravel\Prompts\table;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('set foreign_key_checks=0');

        Aoc::unguard();
        DB::table('aocs')->truncate();
        Aoc::factory()->count(8)->create();


        Product::unguard();
        ProductVariants::unguard();
        Images::unguard();
        DB::table('products')->truncate();
        DB::table('product_variants')->truncate();
        DB::table('images')->truncate();
        Product::factory()->count(4)->has(
            ProductVariants::factory()->count(2)->has(
                Images::factory()->count(2))
            ->afterCreating(function (ProductVariants $product_variant) {
                $product_variant->images()->first()->update(['featured' => true]);
            }))
        ->create();

        DB::table('carts')->truncate();
        DB::table('cart_items')->truncate();
        User::factory()->count(4)->has(
            Carts::factory()->count(1)->has(
                CartItems::factory()->count(2))
        )->create();

        DB::statement('set foreign_key_checks=1');
    }
}
