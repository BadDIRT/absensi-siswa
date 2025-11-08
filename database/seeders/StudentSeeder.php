<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\SchoolClass;
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
                    'nisn' => fake()->unique()->numerify('00########'),
                    'name' => fake()->name(),
                    'gender' => fake()->randomElement(['L', 'P']),
                    'date_of_birth' => fake()->date(),
                ],
                [
                    'class_id' => SchoolClass::all()->random()->id,
                    'nisn' => fake()->unique()->numerify('00########'),
                    'name' => fake()->name(),
                    'gender' => fake()->randomElement(['L', 'P']),
                    'date_of_birth' => fake()->date(),
                ],
                [
                    'class_id' => SchoolClass::all()->random()->id,
                    'nisn' => fake()->unique()->numerify('00########'),
                    'name' => fake()->name(),
                    'gender' => fake()->randomElement(['L', 'P']),
                    'date_of_birth' => fake()->date(),
                ],
            ]);
    }
}
