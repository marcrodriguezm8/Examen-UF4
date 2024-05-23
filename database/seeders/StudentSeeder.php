<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i = 0; $i < 10; $i++){
            $student = Student::create([
                'name' => fake()->firstName(),
                'email' => fake()->unique()->safeEmail(),
                'birthDate' => fake()->date('Y-m-d'),
                'course_id' => fake()->numberBetween(1, 5)

            ]);
        }

    }
}
