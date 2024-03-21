<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sessions>
 */
class SessionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->hexColor(),
            'user_id' => User::factory(),
            'ip_address' => $this->faker->ipv4,
            'user_agent' => $this->faker->image,
            'payload' => $this->faker->paragraph(2),
            'last_activity' => 1
        ];
    }
}
