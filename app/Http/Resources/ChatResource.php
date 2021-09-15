<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'ad_id' => $this->ad_id,
            'user_id' => $this->user_id,
            'messages' => ChannelResource::collection($this->whenLoaded('messages')),
        ];
    }
}
