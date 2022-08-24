<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiBots extends Model
{
    use HasFactory;

    public function messages() {
        return $this->hasMany(AiChat::class, 'bot_id', 'id');
    }

    public function channel(){
        return $this->belongsTo(Channel::class);
    }
}
