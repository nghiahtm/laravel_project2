<?php

namespace App\Http\Resources\V1;

use App\Models\Manufacturers;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $manufacturers = Manufacturers::all();
        $manufacturer = $manufacturers->find($this->manufacturer_id);
        return [
            "id" => $this->id,
            "name" => $this->name,
            "image" => $this->image,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
            "description" => $this->description,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "manufacturer" => new ManufacturerResource($manufacturer)
        ];
    }
}
