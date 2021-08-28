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
            'name' =>$this->name,
            'title' => $this->title,
            'description' => $this->description,
            'category' => CategoryResource::make($this->whenLoaded('category')),
//            'attribute' => AdResource::collection($this->attribute),
            'city' => CityResource::make($this->city),
        ];

    }
}
