<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'channel_id',
        'user_id',
        'bot_id',
    ];

    public function channel() {
        return $this->belongsTo(Channel::class);
    }

    public function bot() {
        return $this->hasOne(AiBots::class, 'id', 'bot_id');
    }
}
