<?php

namespace Database\Factories;

use App\Models\AiBots;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AiChat>
 */
class AiChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $channelId = Channel::where('is_ai', 1)->get()->random()->id;
        $userId = 1;
        $botId = AiBots::all()->random()->first()->id;

        $isBotMessage = mt_rand(0, 1);

        if($isBotMessage){
            $botId = $botId;
            $userId = null;
        } else {
            $botId = null;
            $userId = $userId;
        }

        return [
            'message' => $this->faker->sentence,
            'channel_id' => $channelId,
            'user_id' => $userId,
            'bot_id' => $botId,
        ];
    }
}
