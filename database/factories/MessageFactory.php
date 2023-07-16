<?php

namespace Database\Factories;

use App\Enums\MessageRole;
use App\Models\Persona;
use GuidoCella\EloquentPopulator\Populator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [...Populator::guessFormatters($this->modelName()), ...[
            'role' => $this->faker->randomElement(MessageRole::cases()),
            'name' => fn ($attrs) => Persona::findOrFail($attrs['persona_id'])->name,
            'function_call' => null,
        ]];
    }
}
