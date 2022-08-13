<?php

namespace App\Http\Resources\Channel;

use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'is_ai' => $this->is_ai,
            'ai' => $this->bot,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
