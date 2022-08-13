<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiBots extends Model
{
    use HasFactory;

    public function chats(){
        return $this->hasMany(Chats::class);
    }

    public function channel(){
        return $this->belongsTo(Channel::class);
    }
}
