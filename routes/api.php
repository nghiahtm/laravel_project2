<?php

use App\Http\Controllers\Api\V1\AuthenticationController;
use App\Http\Controllers\api\V1\ManufacturersController;
use App\Http\Controllers\api\V1\ProductController;
use \App\Http\Controllers\Api\V1\UploadImageController;
use \App\Http\Controllers\api\V1\OrdersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix'=> 'v1'],function (){
    Route::apiResource("products",ProductController::class);
    Route::apiResource("manufacturers",ManufacturersController::class);
    Route::apiResource("auth",AuthenticationController::class);
    Route::apiResource("orders",OrdersController::class);
});

Route::group([
    'prefix' => 'v1',
    'headers' => ['Accept' => 'application/json']
], function () {
    Route::post('login', [AuthenticationController::class,"login"]);
    Route::post('refresh-token', [AuthenticationController::class,"refresh"]);
    Route::post('register', [AuthenticationController::class,"register"]);
});

Route::middleware(["auth:api"])->group( function () {
    Route::post('v1/logout', [AuthenticationController::class,"logout"]);
    Route::post('v1/upload_avatar', [UploadImageController::class,"imageUpload"])->middleware("auth:api");
    Route::get('v1/user', [AuthenticationController::class,"getUser"]);
    Route::post('v1/update', [AuthenticationController::class,"updateUser"]);
});

Route::get("v1/detail_order",[OrdersController::class,"getDetailOrder"]);

