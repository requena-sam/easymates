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
        // Événement 1 - seeding_test_img_ftn
        Event::create([
            'name' => 'Fortnite Champions Series',
            'game_name' => GameName::FORTNITE,
            'address' => 'Paris Convention Center, Paris',
            'country' => 'France',
            'start_date' => '2025-06-15 10:00:00',
            'end_date' => '2025-06-18 22:00:00',
            'description' => 'Le plus grand tournoi Fortnite de la saison réunissant les meilleurs joueurs européens.',
            'image_path' => [
                'folder' => 'uploads/seeding_test_img_ftn',
                'sizes' => [
                    'small' => 'storage/uploads/seeding_test_img_ftn/small.webp',
                    'medium' => 'storage/uploads/seeding_test_img_ftn/medium.webp',
                    'large' => 'storage/uploads/seeding_test_img_ftn/large.webp',
                ],
                'original' => 'storage/uploads/seeding_test_img_ftn/large.webp',
            ],
            'official_ticketing_link' => 'https://fortnite.com/competitive/tickets',
            'secondary_ticketing_link' => 'https://ticketmaster.fr',
        ]);

        // Événement 2 - seeding_test_img_lol
        Event::create([
            'name' => 'League of Legends World Championship',
            'game_name' => GameName::LEAGUE_OF_LEGENDS,
            'address' => 'AccorHotels Arena, Paris',
            'country' => 'France',
            'start_date' => '2025-11-01 18:00:00',
            'end_date' => '2025-11-10 23:00:00',
            'description' => 'Le championnat du monde de League of Legends, l\'événement esport le plus prestigieux de l\'année.',
            'image_path' => [
                'folder' => 'uploads/seeding_test_img_lol',
                'sizes' => [
                    'small' => 'storage/uploads/seeding_test_img_lol/small.webp',
                    'medium' => 'storage/uploads/seeding_test_img_lol/medium.webp',
                    'large' => 'storage/uploads/seeding_test_img_lol/large.webp',
                ],
                'original' => 'storage/uploads/seeding_test_img_lol/large.webp',
            ],
            'official_ticketing_link' => 'https://lolesports.com/tickets',
            'secondary_ticketing_link' => null,
        ]);

        // Événement 3 - seeding_test_img_rl
        Event::create([
            'name' => 'Rocket League Championship Series',
            'game_name' => GameName::ROCKET_LEAGUE,
            'address' => 'Zénith de Lille, Lille',
            'country' => 'France',
            'start_date' => '2025-08-20 14:00:00',
            'end_date' => '2025-08-22 20:00:00',
            'description' => 'La finale européenne du RLCS avec les meilleures équipes du continent s\'affrontant pour le titre.',
            'image_path' => [
                'folder' => 'uploads/seeding_test_img_rl',
                'sizes' => [
                    'small' => 'storage/uploads/seeding_test_img_rl/small.webp',
                    'medium' => 'storage/uploads/seeding_test_img_rl/medium.webp',
                    'large' => 'storage/uploads/seeding_test_img_rl/large.webp',
                ],
                'original' => 'storage/uploads/seeding_test_img_rl/large.webp',
            ],
            'official_ticketing_link' => 'https://rocketleague.com/esports/tickets',
            'secondary_ticketing_link' => 'https://fnacspectacles.com',
        ]);
    }
}
