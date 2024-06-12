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
            'user_name' => $this->full_name,
            'products_cart' => json_decode($this->products_cart),
            'status_order' => $this->checkStatus($this->status_order),
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'id' => $this->id,
            'total_bill' => $this->total_bill,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    private function checkStatus($status)
    {
        switch ($status) {
            case "1":
            default :
                return 'Pending';
            case "2":
                return "Delivering";
            case "3":
                return "Delivered";
            case "4":
                return "Success";
            case "5":
                return "Canceled";
        }
    }
}
