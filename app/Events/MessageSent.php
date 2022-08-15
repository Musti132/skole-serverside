<?php

namespace App\Events;

use App\Http\Resources\Events\ChatResource;
use App\Models\Chat;
use App\Models\User;
use App\Models\Channel as ChannelModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $chat;
    public $channel;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Chat $chat, ChannelModel $channel)
    {
        $this->chat = $chat;
        $this->channel = $channel;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-'.$this->channel->id);
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }

    public function broadcastWith(){
        return [
            'message' => new ChatResource($this->chat),
        ];
    }
}
