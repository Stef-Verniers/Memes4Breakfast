<?php

namespace Database\Factories;

use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Laravel\Prompts\text;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meme>
 */
class MemeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'caption' => fake()->text(30),
            'meme' => fake()->imageUrl(),
            'user_id' => fake()->numberBetween(1,3),
            'likes' => fake()->numberBetween(0,199)
        ];
    }
}
