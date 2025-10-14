<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $count = 100;  // nechta student yaratamiz
        $base = 231;   // bosh raqam

        for ($i = 0; $i < $count; $i++) {
            // 231 + tasodifiy 4 xonali raqam → masalan 2312136
            $randNum = rand(1000, 9999);
            $studentId = (int)("{$base}{$randNum}");

            // Factory orqali random ism va familiya yaratamiz
            $student = Student::factory()->make();
            $name = $student->name;
            $lastname = $student->lastname;

            // Ismning 1-harfi kichik
            $firstLetter = strtolower(substr($name, 0, 1));

            // Email: student_id + ism harfi + @jdu.uz
            // Masalan: 2312136a@jdu.uz
            $email = "{$studentId}{$firstLetter}@jdu.uz";

            Student::create([
                'student_id' => $studentId,
                'name' => $name,
                'lastname' => $lastname,
                'email' => $email,
            ]);
        }
    }
}
