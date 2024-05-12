<?php

namespace App\Http\Controllers\api\V1;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreManufacturersRequest;
use App\Http\Requests\UpdateManufacturersRequest;
use App\Http\Resources\Api\V1\ManufacturerCollection;
use App\Http\Resources\Api\V1\ManufacturerResource;
use App\Models\Manufacturers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManufacturersController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('perPage');
        if(empty($perPage)){
            $perPage = 10;
        }
        return $this->sentSuccessResponse(
            new ManufacturerCollection(Manufacturers::paginate($perPage))
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
    public function store(StoreManufacturersRequest $request)
    {
        $manuData = $request->all();
        $manuResource = new ManufacturerResource(Manufacturers::create($manuData));
            return $manuResource;
    }

    /**
     * Display the specified resource.
     */
    public function show(Manufacturers $manufacturer)
    {
        $manufacturerFind = new ManufacturerResource($manufacturer);
        return $this->sentSuccessResponse($manufacturerFind);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manufacturers $manufacturers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManufacturersRequest $request, Manufacturers $manufacturers,$id)
    {
                $manuFind = $manufacturers->findOrFail($id);
                $manuFind->update($request->all());
                return response()->json([
                    "message"=>"update success",
                    "status"=>Response::HTTP_ACCEPTED,
                ],Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manufacturers $manufacturers,$id)
    {
        $manuFind = $manufacturers->findOrFail($id);
        $manuFind->delete();
        return $this->sentSuccessResponse(
            "",
            "delete_success"
        );
    }
}
