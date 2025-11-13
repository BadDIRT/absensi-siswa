<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert([
    [
        'name' => 'Rekayasa Perangkat Lunak',
        'code' => 'RPL',
        'description' => 'Jurusan perangkat lunak dan pemrograman.',
        'head_teacher_id' => Teacher::all()->random()->id,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Teknik Komputer dan Jaringan',
        'code' => 'TKJ',
        'description' => 'Jurusan jaringan dan sistem komputer.',
        'head_teacher_id' => Teacher::all()->random()->id,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Multimedia',
        'code' => 'MM',
        'description' => 'Jurusan desain dan multimedia.',
        'head_teacher_id' => Teacher::all()->random()->id,
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);
    }
}
