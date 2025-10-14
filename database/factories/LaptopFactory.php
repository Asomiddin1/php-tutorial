<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LaptopFactory extends Factory
{
    public function definition(): array
    {
        return [
            'brand' => $this->faker->randomElement(['ASUS', 'HP', 'Lenovo', 'Dell', 'Apple', 'Acer']),
            'price' => $this->faker->randomFloat(2, 500, 3000),
            'color' => $this->faker->safeColorName(),
        ];
    }
}
