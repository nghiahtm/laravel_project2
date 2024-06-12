<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Admin\AdminRequestOrder;
use App\Http\Resources\Api\V1\OrdersCollection;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function getAllOrder(Request $request)
    {
        $search = $request->search;
        if(!isset($request->orderBy)) {
            $request->orderBy = "DESC";
        }
        if(!isset($request->search)) {
            $search = "";
        }
        $orders = Order::
        where('full_name', 'LIKE', '%'.$search.'%')->
            orWhere('phone_number', 'LIKE', '%'.$search.'%')->
        orderBy("created_at",$request->orderBy)->paginate(10);
        return $this->sentSuccessResponse(new OrdersCollection($orders));
    }

    public function updateStatusOrder(AdminRequestOrder $request)
    {
        $id = $request["id"];
        $status = $request["status"];
        if(!isset($status)){
            $status = "0";
        }
        $order =  Order::where("id",$id)
            ->first();
        $order->status_order = $status;
        $order->update();
        return $this->sentSuccessResponse("Update Status Successfully");
    }

}
