<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Channel\ChannelResource;
use App\Models\Channel;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function getRouteKeyName(){
        return 'id';
    }

    public function index() {
        $channels = Channel::with('bot')->get();

        return ChannelResource::collection($channels);
    }

    public function show(Channel $channel) {
        $channel->load(['messages.user', 'bot']);

        return new ChannelResource($channel);
    }

    public function sendMessage(Channel $channel) {
        $channel->load(['messages.user', 'bot']);

        $message = $channel->messages()->create([
            'user_id' => auth()->id(),
            'message' => request('message'),
        ]);

        broadcast(new MessageSent($message, $channel))->toOthers();

        return response()->json([
            'message' => 'Message sent successfully',
            'data' => $message,
        ]);
    }
}
