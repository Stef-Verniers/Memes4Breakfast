<?php
# database/factories/PostFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(30),
            'caption' => fake()->text(80),
            'meme' => fake()->imageUrl(640, 640, 'meme'),
            'user_id' => fake()->numberBetween(1,3),
            'likes' => fake()->numberBetween(0, 100),
        ];
    }
}