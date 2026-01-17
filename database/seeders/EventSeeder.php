<?php

namespace Database\Seeders;

use App\Enums\GameName;
use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'name' => 'Fortnite Champions Series',
            'game_name' => GameName::FORTNITE,
            'address' => 'Paris Convention Center, Paris',
            'country' => 'France',
            'start_date' => '2026-06-15 10:00:00',
            'end_date' => '2026-06-18 22:00:00',
            'image_uuid' => 'fortnite-wallpaper',
            'description' => 'Le plus grand tournoi Fortnite de la saison réunissant les meilleurs joueurs européens.',
            'official_ticketing_link' => 'https://fortnite.com/competitive/tickets',
            'secondary_ticketing_link' => 'https://ticketmaster.fr',
        ]);
        Event::create([
            'name' => 'League of Legends World Championship',
            'game_name' => GameName::LEAGUE_OF_LEGENDS,
            'address' => 'AccorHotels Arena, Paris',
            'country' => 'France',
            'start_date' => '2026-04-01 18:00:00',
            'end_date' => '2026-04-10 23:00:00',
            'image_uuid' => 'lol-wallpaper',
            'description' => 'Le championnat du monde de League of Legends, l\'événement esport le plus prestigieux de l\'année.',
            'official_ticketing_link' => 'https://lolesports.com/tickets',
            'secondary_ticketing_link' => null,
        ]);

        Event::create([
            'name' => 'Rocket League Championship Series',
            'game_name' => GameName::ROCKET_LEAGUE,
            'address' => 'Zénith de Lille, Lille',
            'country' => 'France',
            'start_date' => '2026-02-20 14:00:00',
            'end_date' => '2026-08-22 20:00:00',
            'image_uuid' => 'rl-wallpaper',
            'description' => 'La finale européenne du RLCS avec les meilleures équipes du continent s\'affrontant pour le titre.',
            'official_ticketing_link' => 'https://rocketleague.com/esports/tickets',
            'secondary_ticketing_link' => 'https://fnacspectacles.com',
        ]);
    }
}
