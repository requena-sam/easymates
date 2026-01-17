<?php

namespace Database\Factories;

use App\Models\CoHosting;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoHosting>
 */
class CoHostingFactory extends Factory
{
    protected $model = CoHosting::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [
            [
                "storage/uploads/seeding_test_img_ftn/large.webp",
                "storage/uploads/seeding_test_img_rl/large.webp"
            ],
            [
                "storage/uploads/seeding_test_img_rl/medium.webp"
            ],
            [
                "storage/uploads/seeding_test_img_ftn/medium.webp",
                "storage/uploads/seeding_test_img_rl/small.webp"
            ],
            [
                "storage/uploads/seeding_test_img_ftn/small.webp",
                "storage/uploads/seeding_test_img_rl/large.webp",
                "storage/uploads/seeding_test_img_ftn/large.webp"
            ],
        ];

        $titles = [
            'Appartement moderne centre-ville',
            'Maison spacieuse avec jardin',
            'Studio cosy hypercentre',
            'Loft industriel rénové',
            'Chambre dans colocation de gamers',
            'Villa avec piscine',
            'Duplex lumineux',
            'Appartement avec terrasse',
            'Penthouse vue panoramique',
            'Chambre d\'hôte chaleureuse',
        ];

        $addresses = [
            'Lyon, France',
            'Part-Dieu, Lyon',
            'Confluence, Lyon',
            'Villeurbanne',
            'Bron, Lyon',
            'Vieux Lyon',
            'Croix-Rousse, Lyon',
            'Presqu\'île, Lyon',
        ];

        $startDate = $this->faker->dateTimeBetween('now', '+2 months');
        $endDate = (clone $startDate)->modify('+' . $this->faker->numberBetween(2, 7) . ' days');

        return [
            'event_id' => $this->faker->numberBetween(1, Event::count()),
            'user_id' => $this->faker->numberBetween(1, User::count()),
            'title' => $this->faker->randomElement($titles),
            'description' => $this->faker->realText(150),
            'author_message' => $this->faker->optional(0.8)->realText(200),
            'available_spots' => $this->faker->numberBetween(2, 10),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'address' => $this->faker->randomElement($addresses),
            'price_per_person' => $this->faker->randomFloat(2, 50, 200),
            'listing_link' => $this->faker->optional(0.6)->url(),
            'whatsapp' => $this->faker->optional(0.7)->phoneNumber(),
            'discord' => $this->faker->optional(0.8)->userName() . '#' . $this->faker->numberBetween(1000, 9999),
            'twitter' => $this->faker->optional(0.5)->userName(),
            'instagram' => $this->faker->optional(0.6)->userName(),
        ];
    }
}
