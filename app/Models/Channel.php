<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    public function chats(){
        return $this->hasMany(Chat::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function bot(){
        return $this->hasOne(AiBots::class, 'id', 'ai_bot_id');
    }
}
