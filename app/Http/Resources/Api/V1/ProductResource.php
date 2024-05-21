<?php

namespace App\Http\Resources\Api\V1;

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
            "os"=> $this->os,
            "ram"=> $this->ram,
            "storage"=> $this->storage,
            "display"=> $this->display_in_inch,
            "processor"=> $this->processor,
            "selling_price" => $this->selling_price,
            "original_price" => $this->original_price,
            "manufacturer" => new ManufacturerResource($manufacturer)
        ];
    }
}
