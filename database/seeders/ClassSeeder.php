<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\SchoolClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = SchoolClass::pluck('teacher_id')->toArray();

        $teacherIds = \App\Models\Teacher::pluck('id')->toArray();
    $departments = Department::pluck('id')->toArray();

    SchoolClass::insert([
        [
            'department_id' => collect($departments)->random(),
            'grade' => 10,
            'teacher_id' => collect($teacherIds)->random(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'department_id' => collect($departments)->random(),
            'grade' => 11,
            'teacher_id' => collect($teacherIds)->random(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'department_id' => collect($departments)->random(),
            'grade' => 12,
            'teacher_id' => collect($teacherIds)->random(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]); 
    }
}
