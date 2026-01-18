<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Creation;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $admin = User::find(1);
        $admin->assignRole('admin');
        $this->call(EventSeeder::class);
    }
}
