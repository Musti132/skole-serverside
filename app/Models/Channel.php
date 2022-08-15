<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_ai',
        'bot_id',
    ];

    public function messages(){
        return $this->hasMany(Chat::class)->orderBy('created_at', 'ASC');
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function bot(){
        return $this->hasOne(AiBots::class, 'id', 'ai_bot_id');
    }
}
