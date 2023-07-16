<?php

namespace Database\Factories;

use GuidoCella\EloquentPopulator\Populator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [...Populator::guessFormatters($this->modelName()), ...[
            'name' => $this->faker->catchPhrase(),
        ]];
    }
}
