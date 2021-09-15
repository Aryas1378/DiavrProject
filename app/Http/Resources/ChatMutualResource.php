<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatMutualResource extends JsonResource
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
            'message' => $this->message,
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'ad_id' => $this->ad_id,
            'chat_starter' => $this->chat_starter,

        ];
    }
}
