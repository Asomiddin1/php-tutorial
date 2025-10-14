<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laptop;

class LaptopSeeder extends Seeder
{
    public function run(): void
    {
        Laptop::factory()->count(10)->create();
    }
}
