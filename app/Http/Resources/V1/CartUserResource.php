<?php

namespace App\Http\Resources\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $cartsProduct = collect();
        if(empty($this->products)){
            $cartsProduct = [];
        }else{
            foreach (array_keys($this->products) as $id){
                $cartsProduct->push(new ProductsCartResource(Product::find($id)));
            }
        }
        return [
            "fullName"=> $this->fullName,
            "phone_number"=> $this->phoneNumber,
            "address"=> $this->address,
            "products"=> $cartsProduct,
            "statusOrder" => $this->status,
        ];
    }
}
