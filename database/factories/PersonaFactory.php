<?php

namespace Database\Factories;

use App\Actions\GenerateAvatar;
use App\Models\Persona;
use GuidoCella\EloquentPopulator\Populator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prompt = $this->faker->randomElement(config('legion.prompts'));

        return [...Populator::guessFormatters($this->modelName()), ...[
            'name' => $this->faker->name(),
            'act' => $prompt['act'],
            'prompt' => $prompt['prompt'],
            'avatar' => '',
        ]];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Persona $persona) {
            $persona->storeAvatar(app()->call(GenerateAvatar::class, [
                'name' => $persona->name,
                'act' => $persona->act,
            ]));
            $persona->save();
        });
    }
}
