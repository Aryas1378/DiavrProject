<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SiteAttributeResource extends JsonResource
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
            'value' => $this->whenPivotLoaded('ad_attributes',$this->pivot->value),
            'default_values' =>defaultValuesResource::collection($this->whenLoaded('defaultValues')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories'))
        ];
    }
}
