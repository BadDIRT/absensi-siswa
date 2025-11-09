<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Student;
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
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Teknik Komputer dan Jaringan',
        'code' => 'TKJ',
        'description' => 'Jurusan jaringan dan sistem komputer.',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Multimedia',
        'code' => 'MM',
        'description' => 'Jurusan desain dan multimedia.',
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);
    }
}
