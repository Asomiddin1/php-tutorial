<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    public function definition(): array
    {
        return [
            'model' => $this->faker->randomElement(['BMW X5', 'Tesla Model 3', 'Toyota Camry', 'Chevrolet Malibu', 'Hyundai Sonata']),
            'year' => $this->faker->numberBetween(2015, 2025),
            'price' => $this->faker->randomFloat(2, 10000, 80000),
        ];
    }
}
