<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::insert([
                [
                    'class_id' => SchoolClass::all()->random()->id,
                    'teacher_id' => Teacher::all()->random()->id,
                    'department_id' => SchoolClass::all()->random()->department_id,
                    'nisn' => fake()->unique()->numerify('00########'),
                    'nipd' => fake()->unique()->numerify('2023#####'),
                    'name' => fake()->name(),
                    'gender' => fake()->randomElement(['L', 'P']),
                    'date_of_birth' => fake()->date(),
                ],
                [
                    'class_id' => SchoolClass::all()->random()->id,
                    'teacher_id' => Teacher::all()->random()->id,
                    'department_id' => SchoolClass::all()->random()->department_id,
                    'nisn' => fake()->unique()->numerify('00########'),
                    'nipd' => fake()->unique()->numerify('2023#####'),
                    'name' => fake()->name(),
                    'gender' => fake()->randomElement(['L', 'P']),
                    'date_of_birth' => fake()->date(),
                ],
                [
                    'class_id' => SchoolClass::all()->random()->id,
                    'teacher_id' => Teacher::all()->random()->id,
                    'department_id' => SchoolClass::all()->random()->department_id,
                    'nisn' => fake()->unique()->numerify('00########'),
                    'nipd' => fake()->unique()->numerify('2023#####'),
                    'name' => fake()->name(),
                    'gender' => fake()->randomElement(['L', 'P']),
                    'date_of_birth' => fake()->date(),
                ],
            ]);
    }
}
