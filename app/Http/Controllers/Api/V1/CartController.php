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
            ->orWhere("hidden",null)
            ->first();
        return $this->sentSuccessResponse($cart);
    }
    private function cartCollection(Request $request)
    {
        $cartProducts = collect();
        if(empty($request->products)){
            return $cartProducts;
        }
        $products = collect($request->products);
        foreach ($products->keys() as $id){
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
        return $cartProducts;
    }
    private function cartUpdate(Request $request,Carts $cart)
    {
        $productsRequest = json_decode($cart->products,true);
        $cartProducts = collect($productsRequest);
        if(empty($request->products)){
            return $cartProducts;
        }
        $changeProducts = collect($request->products);
        $idRequest = $changeProducts->keys()->first();
        $findProductInCart = $cartProducts->where("id",$idRequest);
        if($findProductInCart->isNotEmpty()){
            $cartProducts = array_map(function ($item) use ($idRequest,$changeProducts) {
                if ($item["id"] == $idRequest) {
                    $item["quantity"] +=  $changeProducts[$idRequest];
                }
                return $item;
            }, $productsRequest);
        }else{
            $newProduct = $this->cartCollection($request)->first();
            $cartProducts->push($newProduct) ;
        }
        return $cartProducts;
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
        if(empty($request->products)){
            return $this->sentErrorResponse("Request products is not empty",401);
        }
        if(count($request->products)>1){
            return $this->sentErrorResponse("Too much request products",401);
        }
        $cart = Carts::where("id",$id)->first();
        $cartProducts = $this->cartUpdate($request,$cart);
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

}
