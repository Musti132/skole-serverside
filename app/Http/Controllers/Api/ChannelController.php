<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Channel\ChannelResource;
use App\Models\Channel;
use App\Events\MessageSent;
use App\Http\Requests\Channel\MessageAiRequest;
use App\Http\Requests\Channel\MessageRequest;
use App\Http\Resources\Channel\ChannelAiResource;
use App\Http\Resources\Chat\MessageAiResource;
use App\Http\Resources\Chat\MessageResource;
use App\Services\OpenAIService;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;

class ChannelController extends Controller
{
    public function __construct(OpenAIService $openAi)
    {
        $this->openAi = $openAi;
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

    public function showAi(Channel $channel)
    {
        if (!$channel->is_ai) {
            return response()->json([
                'message' => 'This channel is not an AI channel.'
            ], 400);
        }

        $channel->load('bot');

        return new ChannelAiResource($channel);
    }

    /**
     * Send a message to an channel
     * 
     * @param MessageRequest $request
     * @param Channel $channel
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(MessageRequest $request, Channel $channel)
    {
        $channel->load(['messages.user', 'bot']);

        $this->openAi->moderate(request('message'));

        if($this->openAi->isFlagged()) {
            return response()->json([
                'status' => 'flagged',
                'message' => 'Your message has been flagged as inappropriate'
            ]);
        }

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

    /**
     * Send a message to an AI channel
     * 
     * @param MessageAiRequest $request
     * @param Channel $channel
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessageAi(MessageAiRequest $request, Channel $channel)
    {

        /**
         * Tjek om kanalen er en AI kanal
         * Hvis ikke, returner en fejl
         */
        
        if (!$channel->is_ai) {
            return response()->json([
                'message' => 'This channel is not an AI channel.'
            ], 400);
        }

        $this->openAi->moderate(request('message'));

        if($this->openAi->isFlagged()) {
            return response()->json([
                'status' => 'flagged',
                'message' => 'Your message has been flagged as inappropriate'
            ]);
        }

        $aiResponse = $this->openAi->complete(request('message'));

        $message = $channel->botMessages()->create([
            'user_id' => auth()->id(),
            'message' => request('message'),
            'channel_id' => $channel->id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Message sent successfully',
            'data' => [
                'ai_response' => ['message' => $aiResponse],
                'message' => new MessageAiResource($message),
            ],
        ]);
    }
}
