<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SiteAdResource extends JsonResource
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
            'title' => $this->title,
            'ad_description' => $this->description,
            'status_description' => $this->status_description,
            'category' => SiteCategoryResource::make($this->whenLoaded('category')),
            'attributes' => SiteAttributeResource::collection($this->whenLoaded('attributes')),
            'city' => CityResource::make($this->whenLoaded('city')),
            'pictures' => PictureResource::collection($this->whenLoaded('pictures')),
            'status' => StatusResource::make($this->whenLoaded('status')),
            'channels' => ChatResource::collection($this->whenLoaded('channels')),
        ];
    }
}
