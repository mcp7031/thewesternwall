<?php

namespace Database\Factories;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();
        return [
            'name' => $this->faker->unique()->randomElement(['Female T-shirt', 'Male T-shirt', 'Cap', 'Coffee Mug', 'Book']),
            'description' => $faker->paragraph(2),
            'price' => $faker->numberBetween(5_00, 45_00),
        ];

    }
}
