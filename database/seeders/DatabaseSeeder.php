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

        // User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Test User',
            'email' => 'sam@test.be',
            'password' => 'samsamsam',
            'profile_picture' => 'https://img.asmedia.epimg.net/resizer/v2/FJ54C73VRJMUZCAXXU7B6RKYNM.jpg?auth=a653163568169f55533323fbe5d5e02e8bf7afbca945209e58757f8556c791e4&width=1472&height=828&smart=true',
        ]);
        $admin->assignRole('admin');


        Creation::factory(10)->create([]);
        Comment::factory(25)->create([]);
        $this->call(EventSeeder::class);
    }
}
