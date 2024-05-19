<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CartResource;
use App\Http\Resources\Api\V1\CartsCollection;
use App\Http\Resources\Api\V1\ProductsCartResource;
use App\Models\Carts;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $cart =  Carts::where("id_user",$user->id)
            ->where("hidden", false)
            ->first();
        return $this->sentSuccessResponse($cart);
    }
    private function cartCollection($request)
    {
        $cartProducts = collect();
        if(empty($request->products)){
            return $cartProducts;
        }
        foreach (array_keys($request->products) as $id){
            $productID = Product::where("id",$id)->first();
            if(!$productID->exists()){
                return $this->sentErrorResponse("ID: $id not exists in product");
            }
            if($request->products[$id] <= 0){
                break;
            }
            $product = new ProductsCartResource($productID);
            $product->quantity =$request->products[$id];
            $cartProducts->push($product);
        }
        return  $cartProducts;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $cart = new Carts;
        $cartProducts = $this->cartCollection($request);
        $cart->products = json_encode($cartProducts);
        $cart->id_user = $user->id;
        $cart->save();
        return $this->sentSuccessResponse("Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cart = Carts::findOrFail($id);
        return $this->sentSuccessResponse(new CartResource($cart));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cart = Carts::where("id",$id)->first();
        $cartProducts = $this->cartCollection($request);
        $cart->products = json_encode($cartProducts);
        $cart->update();
        return $this->sentSuccessResponse("update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Carts::where("id",$id)->first();
        $cart->delete();
        return $this->sentSuccessResponse("delete successfully");
    }

    public function removeProducts(Request $request)
    {
        $request->all();
        $cart = Carts::where("id",$request->id)->first();
        $cartProducts = $this->cartCollection($request);
        $cart->products = json_encode($cartProducts);
        $cart->update();
        return $this->sentSuccessResponse("delete successfully");
    }
}
