<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminAccountSeeder;
use Database\Seeders\StudentAccountSeeder;
use Database\Seeders\TeacherAccountSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('password'),
        // ]);

        $this->call([
            StudentAccountSeeder::class,
            AdminAccountSeeder::class,
            TeacherAccountSeeder::class,
            TeacherSeeder::class,
            DepartmentSeeder::class,
            ClassSeeder::class,
            StudentSeeder::class,
            AttendanceSeeder::class,
        ]);
    }
}
