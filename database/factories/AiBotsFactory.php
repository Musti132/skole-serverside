<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AiBotsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'OpenAI',
            'short' => 'OAI',
            'description' => $this->faker->text,
            'logo_path' => $this->faker->imageUrl(),
        ];
    }
}
