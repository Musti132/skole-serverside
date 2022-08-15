<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Channel\ChannelResource;
use App\Models\Channel;
use App\Events\MessageSent;
use App\Http\Resources\Chat\MessageResource;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;

class ChannelController extends Controller
{
    public function getRouteKeyName()
    {
        return 'id';
    }

    public function index()
    {
        $channels = Channel::with('bot')->get();

        return ChannelResource::collection($channels);
    }

    public function show(Channel $channel)
    {
        $channel->load(['messages.user', 'bot']);

        return new ChannelResource($channel);
    }

    public function sendMessage(Channel $channel)
    {
        $channel->load(['messages.user', 'bot']);

        $message = $channel->messages()->create([
            'user_id' => auth()->id(),
            'message' => request('message'),
        ]);

        broadcast(new MessageSent($message, $channel))->toOthers();

        return response()->json([
            'message' => 'Message sent successfully',
            'data' => new MessageResource($message),
        ]);
    }

    public function sendMessageAi(Channel $channel)
    {
        if (!$channel->bot) {
            return response()->json([
                'message' => 'Bot not found',
            ], 404);
        }

        $channel->load(['messages.user', 'bot']);
        $open_ai = new OpenAi(env('OPEN_AI_API_KEY'));

        $complete = $open_ai->complete([
            'engine' => 'text-davinci-002',
            'prompt' => request('message'),
            'temperature' => 0.7,
            'max_tokens' => 256,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);


        return json_decode($complete, true);

        $message = $channel->messages()->create([
            'user_id' => null,
            'message' => request('message'),
        ]);
    }
}
