<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            $studentId = $faker->unique()->numberBetween(2310000, 2319999); // 231 dan boshlansin

            // ism bosh harfini kichik qilib olish
            $name = strtolower($faker->firstName);
            $lastname = $faker->lastName;

            Student::create([
                'student_id' => $studentId,
                'name' => $name,
                'lastname' => $lastname,
                'email' => $studentId . 'a@jdu.uz',
            ]);
        }
    }
}
