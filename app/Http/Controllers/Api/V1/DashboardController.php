<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\DashboardResource;
use App\Models\Manufacturers;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getInformationDashBoard()
    {
        $countUser = User::all()->count();
        $countProducts = Product::all()->count();
        $countManufacturers = Manufacturers::all()->count();
        $countOrder = Order::all()->count();
        $request = [
            "users"=>$countUser,
            "products"=>$countProducts,
            "manufacturers"=>$countManufacturers,
            "orders"=>$countOrder,
        ];
        return $this->sentSuccessResponse(
            $request,
        );
    }
}
