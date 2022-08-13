<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Channel\ChannelResource;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index() {
        $channels = Channel::with('bot')->get();

        return ChannelResource::collection($channels);
    }
}
