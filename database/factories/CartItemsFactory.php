<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use App\Models\Carts;
use App\Models\ProductVariants;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemsFactory extends Factory
{
    protected $table = 'cart_items';
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $product_variants_ids = DB::table('product_variants')->pluck('id');
        $product_variants_ids = ProductVariants::all()->pluck('id');
        return [
            'carts_id' => Carts::factory(),
            'product_variants_id' => $this->faker->randomElement($product_variants_ids),
            'quantity' => $this->faker->numberBetween(1,10)
        ];
    }
}
