<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRegisterResource extends JsonResource
{
    protected $collectionToken;
    public function __construct($collection)
    {
        parent::__construct($collection);
        $this->collectionToken = $collection;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->collectionToken['name'],
            'email' => $this->collectionToken['email'],
            'phone_number' => $this->collectionToken['phone_number'],
            'genders' => '0',
            'roles' => '0',
            'token'=> $this->collectionToken['token']
        ];
    }
}
