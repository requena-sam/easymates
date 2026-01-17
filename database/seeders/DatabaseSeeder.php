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
        $admin = User::factory()->create([
            'name' => 'Test User',
            'email' => 'sam@test.be',
            'password' => 'samsamsam',
        ]);

        $admin->assignRole('admin');
        $this->call(EventSeeder::class);


        User::factory(10)->create();
        Creation::factory(10)->create();
        Creation::factory(5)->create([
            'user_id' => $admin->id,
        ]);
        Comment::factory(25)->create([]);
        $this->call(CoHostingSeeder::class);
        $this->call(PlayerSeeder::class);
        $this->call(NotificationSeeder::class);
    }
}
