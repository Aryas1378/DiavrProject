<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
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
            'id' => $this->id,
            'ad_id' => $this->ad_id,
            'user_id' => $this->user_id,
            'messages' => MessageResource::collection($this->whenLoaded('messages')),
            'ads' => new AdResource($this->whenLoaded('ad')),
        ];
    }
}
