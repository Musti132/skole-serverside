<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AiBots;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Channel>
 */
class ChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $aiBotId = null;
        $randomAiBot = AiBots::all()->random()->first()->id;

        $isAi = $this->faker->boolean;

        if($isAi){
            $aiBotId = $randomAiBot;
        }

        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'is_ai' => $isAi,
            'ai_bot_id' => $aiBotId,
        ];
    }
}
