<?php

namespace Database\Seeders;

use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
        ]);

        Project::create([
            'name' => 'Project 1',
            'description' => 'Deskripsi proyek 1',
            'start_date' => '2025-01-01',
            'end_date' => '2025-12-31',
        ]);

        Project::create([
            'name' => 'Project 2',
            'description' => 'Deskripsi proyek 2',
            'start_date' => '2025-02-01',
            'end_date' => '2025-11-30',
        ]);

        Task::create([
            'title' => 'Task 1',
            'description' => 'Deskripsi tugas 1',
            'project_id' => 1,
            'user_id' => 1,
        ]);

        Task::create([
            'title' => 'Task 2',
            'description' => 'Deskripsi tugas 2',
            'project_id' => 2,
            'user_id' => 2,
        ]);
    }
}
