<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
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
            'title' => $this->title,
            'ad_description' => $this->description,
            'status' => StatusResource::make($this->whenLoaded('status')),
            'status_description' => $this->status_description,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'attributes' => AttributeResource::collection($this->whenLoaded('attributes')),
            'city' => CityResource::make($this->whenLoaded('city')),
        ];

    }
}
