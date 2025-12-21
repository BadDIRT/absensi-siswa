<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attendance::insert([
            [
                    'student_id' => Student::all()->random()->id,
                    'teacher_id' => Teacher::all()->random()->id,
                    'date' => fake()->date(),
                    'time_in' => fake()->time('H:i'),
                    'time_out' => fake()->time('H:i'),
                    'status' => fake()->randomElement(['hadir', 'sakit', 'izin', 'tidak hadir']),
                    'created_at' => now(),
                    'updated_at' => now(),
            ],
            [
                    'student_id' => Student::all()->random()->id,
                    'teacher_id' => Teacher::all()->random()->id,
                    'date' => fake()->date(),
                    'time_in' => fake()->time('H:i'),
                    'time_out' => fake()->time('H:i'),
                    'status' => fake()->randomElement(['hadir', 'sakit', 'izin', 'tidak hadir']),
                    'created_at' => now(),
                    'updated_at' => now(),
            ],
            [
                    'student_id' => Student::all()->random()->id,
                    'teacher_id' => Teacher::all()->random()->id,
                    'date' => fake()->date(),
                    'time_in' => fake()->time('H:i'),
                    'time_out' => fake()->time('H:i'),
                    'status' => fake()->randomElement(['hadir', 'sakit', 'izin', 'tidak hadir']),
                    'created_at' => now(),
                    'updated_at' => now(),
            ],
        ]);
    }
}
