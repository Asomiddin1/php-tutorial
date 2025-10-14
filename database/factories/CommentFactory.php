<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'post_id' => Post::factory(), // Har bir comment bir postga tegishli bo‘ladi
            'comment' => $this->faker->sentence(),
        ];
    }
}
