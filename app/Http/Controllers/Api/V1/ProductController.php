<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\V1\ProductCollection;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage');
        $manufacturer = $request->get('id_manufacturer');
        if(empty($perPage)){
            $perPage = 10;
        }
        if(empty($manufacturer)){
            $products = new ProductCollection(Product::paginate($perPage));
        }else{
            $products = new ProductCollection(Product::where("products.manufacturer_id",$manufacturer)->paginate($perPage));
        }
        return $this->sentSuccessResponse(
            $products
        );
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
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $detailProduct = new ProductResource($product->loadMissing('manufacturers'));
        return $this->sentSuccessResponse($detailProduct);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        return response()->json([
            "message"=>"update success",
            "status"=>Response::HTTP_ACCEPTED,
        ],Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sentSuccessResponse(
            "",
            "delete_success"
        );
    }
}
