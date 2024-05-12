<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'name' => $this->full_name,
            'products_cart' => json_decode($this->products_cart),
            'status_order' => $this->status_order,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
