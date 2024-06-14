<?php

use App\Http\Controllers\Api\V1\admin\DashboardController;
use App\Http\Controllers\API\V1\admin\InformationUserController;
use App\Http\Controllers\Api\V1\admin\RevenueController;
use App\Http\Controllers\Api\V1\AuthenticationController;
use App\Http\Controllers\API\V1\CartController;
use App\Http\Controllers\api\V1\ManufacturersController;
use App\Http\Controllers\api\V1\OrdersController;
use App\Http\Controllers\api\V1\ProductController;
use App\Http\Controllers\Api\V1\UploadImageController;
use App\Http\Middleware\API\V1\AdminMiddleware;
use App\Http\Middleware\API\V1\AuthMiddleware;
use App\Http\Middleware\API\V1\StatusCodeMiddleware;
use \App\Http\Controllers\API\V1\Admin\AdminOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix'=> 'v1'],function (){
    Route::apiResource("products",ProductController::class);
    Route::apiResource("manufacturers",ManufacturersController::class);
    Route::apiResource("auth",AuthenticationController::class);
});

Route::group([
    'prefix' => 'v1',
    'headers' => ['Accept' => 'application/json']
], function () {
    Route::post('login', [AuthenticationController::class,"login"]);
    Route::post('refresh-token', [AuthenticationController::class,"refresh"]);
    Route::post('register', [AuthenticationController::class,"register"]);
});

Route::group(["prefix"=>"v1","middleware"=>[AuthMiddleware::class,StatusCodeMiddleware::class]], function () {
    Route::post('logout', [AuthenticationController::class,"logout"]);
    Route::post('upload_avatar', [UploadImageController::class,"imageUpload"]);
    Route::get('user', [AuthenticationController::class,"getUser"]);
    Route::post('update', [AuthenticationController::class,"updateUser"]);
    Route::apiResource("orders",OrdersController::class);
    Route::apiResource("carts",CartController::class);//->middleware([NotFoundMiddleware::class]);
    Route::post("carts/{id}",[CartController::class,"removeProduct"]);
    Route::post("orders/confirm",[OrdersController::class,"confirmOrder"]);
    Route::post("orders/cancel",[OrdersController::class,"cancelOrder"]);
});

Route::group(["prefix"=>"v1/admin/","middleware"=>[AuthMiddleware::class,StatusCodeMiddleware::class,AdminMiddleware::class]], function () {
    Route::get('dash_board', [DashboardController::class,"getInformationDashBoard"]);
    Route::get('get_all_orders', [AdminOrderController::class,"getAllOrder"]);
    Route::get('get_revenue', [RevenueController::class,"getAllRevenue"]);
    Route::post('update_status_order', [AdminOrderController::class,"updateStatusOrder"]);
    Route::get('get_all_users', [InformationUserController::class,"getAllUser"]);
    Route::post('get_detail_user', [InformationUserController::class,"getDetailUser"]);
    Route::put("user/{id}", [InformationUserController::class,"updateRoleUser"]);
});

