<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantsFactory extends Factory
{
    public function set_attributes($num) {
        if ($num == 0) return;
        $colour = $this->faker->randomElement(['Blue','Green']);
        $size = $this->faker->randomElement(['S','M','L','XL','XXL']);
        $cover = $this->faker->randomElement(['Soft','Hard']);
        $attribute = 'Colour:'.$colour.',Size:'.$size.',Cover:'.$cover;
        return $attribute;

    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'attribute' => $this->set_attributes(1),
            'quantity' => $this->faker->numberBetween(6,28)
        ];
    }
}
