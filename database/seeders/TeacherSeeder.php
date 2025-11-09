<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    $data = [
        [
            'name' => fake()->name(),
            'nip' => fake()->numerify('19870#####'),
            'gender' => fake()->randomElement(['L', 'P']),
            'phone_number' => fake()->phoneNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => fake()->name(),
            'nip' => fake()->numerify('19870#####'),
            'gender' => fake()->randomElement(['L', 'P']),
            'phone_number' => fake()->phoneNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => fake()->name(),
            'nip' => fake()->numerify('19870#####'),
            'gender' => fake()->randomElement(['L', 'P']),
            'phone_number' => fake()->phoneNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ];

    Teacher::insert($data);


    }
}

