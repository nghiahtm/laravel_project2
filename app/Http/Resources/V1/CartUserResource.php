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
        $cartProducts = collect();
        if(empty($this->products)){
            $cartProducts = [];
        }else{
            foreach (array_keys($this->products) as $id){
                $product = new ProductsCartResource(Product::find($id));
                $product->quantity =$this->products[$id];
                $cartProducts->push($product);
            }
        }
        return [
            "fullName"=> $this->fullName,
            "id_user"=> $this->id,
            "phone_number"=> $this->phoneNumber,
            "address"=> $this->address,
            "products"=> $cartProducts,
            "statusOrder" => $this->status,
        ];
    }
}
