<?php

namespace App\Http\Controllers\api\V1;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreOrdersRequest;
use App\Http\Requests\Api\V1\UpdateOrdersRequest;
use App\Http\Resources\Api\V1\OrdersCollection;
use App\Http\Resources\Api\V1\ProductsCartResource;
use App\Http\Resources\Api\V1\UserOrderResource;
use App\Models\Carts;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if($user->roles === "1"){
            $orders = Order::paginate(10);
            return $this->sentSuccessResponse(new OrdersCollection($orders));
        }
        return  $this->sentErrorResponse("Account not admin");
    }
    public function getDetailOrder()
    {
        $user = auth()->user();
        if (!$user) {
            return  $this->sentErrorResponse("unauthorized",401);
        }
        $orders = Order::where("id_user",$user->id)->first();
        return $this->sentSuccessResponse(new UserOrderResource($orders));
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
            return  $this->sentErrorResponse("Cart is used before",404);
        }
        $cartSelected->hidden = true;
        $order->save();
        $cartSelected->update();
        return $this->sentSuccessResponse("add successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $orders)
    {
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
        return $this-> sentErrorResponse("Order is not for you",404);
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
