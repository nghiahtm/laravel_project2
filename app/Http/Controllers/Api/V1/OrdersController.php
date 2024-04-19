<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Http\Resources\V1\CartUserResource;
use App\Models\OrdersModel;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ["123"];
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
        $carts = new CartUserResource($request);
        return $this->sentSuccessResponse($carts);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrdersModel $orders)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrdersModel $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrdersRequest $request, OrdersModel $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrdersModel $orders)
    {
        //
    }
}
