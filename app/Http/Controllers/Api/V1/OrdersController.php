<?php

namespace App\Http\Controllers\api\V1;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreOrdersRequest;
use App\Http\Requests\Api\V1\UpdateOrdersRequest;
use App\Http\Resources\Api\V1\OrdersCollection;
use App\Models\Carts;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
            $orders =  Order::where("id_user",$user->id)->paginate(10);
            return $this->sentSuccessResponse(new OrdersCollection($orders));
//        return  $this->sentErrorResponse("Account not admin");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrdersRequest $request)
    {
        $user = auth()->user();
        $request->all();
        $order = new Order;
        $this->updateForm($request,$order);
        $order->id_user =  $user->id;
        $cartSelected = Carts::findOrFail($request->id_cart);
        if($cartSelected->hidden){
            return  $this->sentSuccessResponse("Cart is used before",200);
        }
        $cartSelected->hidden = true;
        $order->save();
        $cartSelected->update();
        return $this->sentSuccessResponse("add successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $user = auth()->user();
        $orders = Order::where("id_user",$user->id)->where("id",$order->id)->first();
        return $this->sentSuccessResponse($orders);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $orders)
    {
        //
    }
    private function updateForm(FormRequest $form, Order $order)
    {
        $order->full_name = $form->fullName;
        $order->address = $form->address;
        $order->phone_number = $form->phone_number;
        $order->total_bill = $form->total_bill;
        $order->status_order = "1";
        $carts = Carts::findOrFail($form->id_cart);
        $productsToOrder = $carts->products;
        $order->products_cart = json_encode($productsToOrder);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrdersRequest $request, Order $order)
    {
        $user = auth()->user();
        $id = $order->id_user;
        if($user->id === $id){
            $this->updateForm($request,$order);
            $order->id_user =  $user->id;
            $order->update();
            return $this->sentSuccessResponse("Updated order successfully");
        }
        return $this-> sentSuccessResponse("Order is not for you",);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
            $order->delete();
            return $this->sentSuccessResponse("delete successfully");

    }
}
