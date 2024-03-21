<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aoc>
 */
class AocFactory extends Factory
{
    public function tagList($num_words) {
        $words = $this->faker->words($num_words);
        $tags = '';
        for ($i=0; $i < $num_words-1; $i++) {
            $tags = $tags . $words[$i] . ", ";
        }
        $tags = $tags . $words[$num_words-1];
        return $tags;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return([
            'category' => $this->faker->unique()->randomElement(['Politics', 'Education', 'Farming and Food', 'Other',
                'Medical','Philosophy and Religion', 'Finance and Wealth', 'Climate and Environment','Brave New World']),
            'description' => $this->faker->paragraph(2),
            'taglist' => $this->tagList(16)
        ]);
    }
}
