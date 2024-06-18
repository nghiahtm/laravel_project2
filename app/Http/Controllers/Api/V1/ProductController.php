<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Api\V1\ProductCollection;
use App\Http\Resources\Api\V1\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage');
        $query = Product::query();

        // Thêm điều kiện tìm kiếm dựa trên query param
        $query->when($request->input('search'), function ($q, $name) {
            return $q->where('name', 'like', "%{$name}%");
        });

        $query->when($request->input('price_min'), function ($q, $priceMin) {
            return $q->where('price', '>=', $priceMin);
        });

        $query->when($request->input('price_max'), function ($q, $priceMax) {
            return $q->where('price', '<=', $priceMax);
        });

        $query->when($request->input('id_manufacturer'), function ($q, $id) {
            return $q->where('manufacturer_id', $id);
        });
        $products =  new ProductCollection($query->paginate($perPage));
        return $this->sentSuccessResponse(
            $products
        );
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $productRequest = $request->all();
        $product = new Product;
        $product->name = $productRequest['name'];
        $product->manufacturer_id = $productRequest['id_manufacturer'];
        $product->processor = $productRequest['processor'];
        $product->image_url = $productRequest['image'];
        $product->os = $productRequest['os'];
        $product->storage = $productRequest['storage'];
        $product->ram = $productRequest['ram'];
        $product->display = $productRequest['display'];
        $product->selling_price = $productRequest['selling_price'];
        $product->original_price = $productRequest['original_price'];
        $product->save();
        return $this->sentSuccessResponse("add success");
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
        $requestAll = $request->all();
        $product->image_url = $requestAll["image"];
        $product->update($request->all());
        return $this->sentSuccessResponse("update success");
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
