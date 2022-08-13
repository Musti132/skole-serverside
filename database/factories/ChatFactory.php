<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\User;
use App\Models\AiBots;
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
    public function definition()
    {
        $channelId = Channel::all()->random()->id;
        $userId = User::all()->random()->id;

        return [
            'channel_id' => $channelId,
            'user_id' => $userId,
            'message' => $this->faker->text,
        ];
    }
}
