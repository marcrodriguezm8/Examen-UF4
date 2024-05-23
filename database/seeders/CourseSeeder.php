<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $courses = ['DAW', 'SMIX', 'CAI', 'EDI', 'AF', 'AD', 'DAM'];
        for($i = 0; $i < 5; $i++){
            $course = Course::create([
                'name' => fake()->randomElement($courses),
                'price' => fake()->numberBetween(100,1000)

            ]);
        }

    }
}
