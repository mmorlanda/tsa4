<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create(['name' => 'POS Manager', 'email' => 'manager@example.com', 'password' => Hash::make('password')]);
        Task::create(['title' => 'Review inventory', 'description' => 'Check low-stock products before closing.', 'status' => 'pending', 'due_date' => now()->addDay(), 'is_archived' => false]);
        Task::create(['title' => 'Prepare daily report', 'description' => 'Export the sales summary.', 'status' => 'done', 'due_date' => now(), 'is_archived' => false]);
    }
}
