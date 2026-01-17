<?php

namespace Database\Seeders;

use App\Models\CoHosting;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class CoHostingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();
        $users = User::all();
        foreach ($events as $event) {
            $count = rand(3, 4);
            CoHosting::factory()->count($count)->create([
                'event_id' => $event->id,
                'user_id' => $users->random()->id,
            ]);
        }
        Cohosting::factory()->count(3)->create(
            [
                'user_id' => 1,
            ]
        );
    }
}
