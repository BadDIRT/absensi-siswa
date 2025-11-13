<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::insert([
            [
                'name' => 'Matematika',
                'code' => 'MATH101',
                'description' => 'Mata pelajaran matematika dasar.',
                'teacher_id' => Teacher::all()->random()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bahasa Indonesia',
                'code' => 'INDO101',
                'description' => 'Mata pelajaran bahasa Indonesia.',
                'teacher_id' => Teacher::all()->random()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fisika',
                'code' => 'PHYS101',
                'description' => 'Mata pelajaran fisika dasar.',
                'teacher_id' => Teacher::all()->random()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
