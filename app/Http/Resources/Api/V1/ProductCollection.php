<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $pagination = $this->resource->toArray();
        return [
            'pagination_data' => ProductResource::collection($this->collection),
            "current_page" => $this->currentPage(),
            "first_page_url" =>  $this->getOptions()['path'].'?'.$this->getOptions()['pageName'].'=1',
            "prev_page_url" =>  $this->previousPageUrl(),
            "next_page_url" =>  $this->nextPageUrl(),
            "last_page_url" =>  $this->url($this->lastPage()),
            'last_page' => $this->lastPage(),
            'per_page' => $this->perPage(),
            'total' => $this->total(),
            'path' => $this->path(),
        ];
    }
}
