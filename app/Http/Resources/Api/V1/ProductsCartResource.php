<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Manufacturers;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsCartResource extends JsonResource
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
            "image" => $this->image_url,
            "price" => $this->selling_price,
            "quantity" => $this->quantity,
            "manufacturer"=>$manufacturer->name
        ];
    }
}
