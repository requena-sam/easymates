<?php

namespace Database\Factories;

use App\Enums\GameName;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('now', '+6 months');
        $endDate = fake()->dateTimeBetween($startDate, $startDate->format('Y-m-d H:i:s').' +7 days');

        return [
            'name' => fake()->words(3, true) . ' Championship',
            'game_name' => GameName::random(),
            'address' => fake()->streetAddress() . ', ' . fake()->city(),
            'country' => fake()->country(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'description' => fake()->paragraphs(3, true),
            'image_path' => 'events/' . fake()->uuid() . '.jpg',
            'official_ticketing_link' => fake()->url(),
            'secondary_ticketing_link' => fake()->optional(0.6)->url(),
        ];
    }
}
