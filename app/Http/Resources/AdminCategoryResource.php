<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminCategoryResource extends JsonResource
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
            'name' => $this->name,
            'children' => CategoryResource::collection($this->whenLoaded('children')),
            'city' => CityResource::make($this->whenLoaded('city')),
            'attributes' => AttributeResource::collection($this->attributes),
            'parent' => CategoryResource::make($this->whenLoaded('parent')),
            'ad' => AdResource::make($this->whenLoaded('ad')),

        ];
    }
}
