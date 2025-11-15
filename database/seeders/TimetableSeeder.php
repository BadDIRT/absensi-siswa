<?php

namespace Database\Seeders;

use App\Models\Timetable;
use Ramsey\Uuid\Type\Time;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TimetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Timetable::insert([
            [
                'class_id' => 1,
                'subject_id' => 1,
                'teacher_id' => 1,
                'day' => 'senin',
                'start_time' => '08:00:00',
                'end_time' => '09:30:00',
            ],
            [
                'class_id' => 1,
                'subject_id' => 2,
                'teacher_id' => 2,
                'day' => 'selasa',
                'start_time' => '10:00:00',
                'end_time' => '11:30:00',
            ],
            [
                'class_id' => 2,
                'subject_id' => 3,
                'teacher_id' => 3,
                'day' => 'rabu',
                'start_time' => '13:00:00',
                'end_time' => '14:30:00',
            ],
            [
                'class_id' => 2,
                'subject_id' => 1,
                'teacher_id' => 1,
                'day' => 'kamis',
                'start_time' => '08:00:00',
                'end_time' => '09:30:00',
            ],
            [
                'class_id' => 3,
                'subject_id' => 2,
                'teacher_id' => 2,
                'day' => 'jumat',
                'start_time' => '10:00:00',
                'end_time' => '11:30:00',
            ],
            [
                'class_id' => 3,
                'subject_id' => 3,
                'teacher_id' => 3,
                'day' => 'senin',
                'start_time' => '13:00:00',
                'end_time' => '14:30:00',
            ],
            [
                'class_id' => 1,
                'subject_id' => 1,
                'teacher_id' => 1,
                'day' => 'rabu',
                'start_time' => '08:00:00',
                'end_time' => '09:30:00',
            ],
            [
                'class_id' => 2,
                'subject_id' => 2,
                'teacher_id' => 2,
                'day' => 'kamis',
                'start_time' => '10:00:00',
                'end_time' => '11:30:00',
            ],
            [
                'class_id' => 3,
                'subject_id' => 3,
                'teacher_id' => 3,
                'day' => 'jumat',
                'start_time' => '13:00:00',
                'end_time' => '14:30:00',
            ],
            [
                'class_id' => 1,
                'subject_id' => 2,
                'teacher_id' => 2,
                'day' => 'selasa',
                'start_time' => '13:00:00',
                'end_time' => '14:30:00',
            ],
            [
                'class_id' => 2,
                'subject_id' => 3,
                'teacher_id' => 3,
                'day' => 'jumat',
                'start_time' => '08:00:00',
                'end_time' => '09:30:00',
            ],
            [
                'class_id' => 3,
                'subject_id' => 1,
                'teacher_id' => 1,
                'day' => 'senin',
                'start_time' => '10:00:00',
                'end_time' => '11:30:00',
            ],
            [
                'class_id' => 1,
                'subject_id' => 3,
                'teacher_id' => 3,
                'day' => 'kamis',
                'start_time' => '13:00:00',
                'end_time' => '14:30:00',
            ],
            [
                'class_id' => 2,
                'subject_id' => 1,
                'teacher_id' => 1,
                'day' => 'rabu',
                'start_time' => '10:00:00',
                'end_time' => '11:30:00',
            ],
            [
                'class_id' => 3,
                'subject_id' => 2,
                'teacher_id' => 2,
                'day' => 'jumat',
                'start_time' => '13:00:00',
                'end_time' => '14:30:00',
            ],
            [
                'class_id' => 1,
                'subject_id' => 1,
                'teacher_id' => 1,
                'day' => 'senin',
                'start_time' => '10:00:00',
                'end_time' => '11:30:00',
            ],
        ]);
    }
}
