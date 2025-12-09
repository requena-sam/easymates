<?php

namespace Database\Factories;

use App\Enum\PostTags;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Creation>
 */
class CreationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'tags' => collect(PostTags::cases())->pluck('value')->shuffle()->take(3)->values()->toArray(),
            'likes_count' => $this->faker->numberBetween(0, 100),
        ];
    }
}
