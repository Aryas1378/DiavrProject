<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'items' => CategoryResource::collection($this->collection),
            'pagination' => [
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'current_page_url' => $this->url($request->query('page')),
                'next_page_url' => $this->nextPageUrl(),
                'previous_page_url' => $this->previousPageUrl(),
            ]
        ];
    }
}
