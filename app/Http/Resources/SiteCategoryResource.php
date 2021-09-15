<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SiteCategoryResource extends JsonResource
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
            'name' => $this->name,
            'children' => CategoryResource::collection($this->whenLoaded('children')),
            'city' => CityResource::make($this->whenLoaded('city')),
            'attributes' => AttributeResource::collection($this->whenLoaded('attributes')),
            'parent' => CategoryResource::make($this->whenLoaded('parent')),
            'ads' => AdResource::collection($this->whenLoaded('ads')),
        ];
    }
}
