<?php

namespace App\Http\Controllers\Api\V1\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function getAllRevenue(Request $request)
    {
        $request->month;
        $orders = collect();
        for ($i = 1; $i < 12; $i++){
            $orders = Order::whereMonth('created_at', $i)->get();
        }

        return $this->sentSuccessResponse($orders);
    }
}
