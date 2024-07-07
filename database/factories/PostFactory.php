<?php

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
            'title' => fake()->sentence(),
            'slug' => fake()->slug(),
            'category_id' => fake()->randomElement(['Berita', 'Info']),
            'cover' => 'https://loremflickr.com/320/240',
            'content' => fake()->realText(),
            'user_id' => '1',
            'status' => 'publish'
        ];
    }
}
