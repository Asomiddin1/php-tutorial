<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::factory()
            ->count(10)
            ->hasComments(3) // har bir postga 3 ta comment
            ->create();
    }
}
