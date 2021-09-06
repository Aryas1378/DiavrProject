<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'children' => CategoryResource::collection($this->whenLoaded('children')),
            'city' => CityResource::make($this->whenLoaded('city')),
            'attributes' => AttributeResource::collection($this->whenLoaded('attributes')),
            'parent' => CategoryResource::make($this->whenLoaded('parent')),
            'ads' => AdResource::collection($this->whenLoaded('ads')),
        ];
    }
}
