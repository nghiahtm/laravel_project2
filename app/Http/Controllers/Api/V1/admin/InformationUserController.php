<?php

namespace App\Http\Controllers\API\V1\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\admin\AdminUserCollection;
use App\Http\Resources\Api\V1\ProductCollection;
use App\Http\Resources\Api\V1\UserDetailResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class InformationUserController extends Controller
{
    public function getAllUser(Request $request)
    {
        $perPage = $request->get('perPage');
        $search = $request->get("search");
        if(empty($perPage)) {
            $perPage = 10;
        }
        $users= User::where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('phone_number', 'like', "%$search%");
        })->paginate($perPage);
            $users = new AdminUserCollection($users);
        return $this->sentSuccessResponse(
            $users
        );
    }

    public function getDetailUser(Request $request)
    {
        $id = $request['id'];
        if(!isset($id)){
            return $this->sentErrorResponse(
                "Not Found"
            );
        }
        $user= User::where("id",$id)->first();
        return $this->sentSuccessResponse(
            $user
        );
    }
}
