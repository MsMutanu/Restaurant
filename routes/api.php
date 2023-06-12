<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\InventoryLevelsController;
use App\Http\Controllers\Api\InventoryOrderHistoryController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductNameController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\RestaurantTableController;
use App\Http\Controllers\Api\WaiterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('bill', BillController::class);
Route::apiResource('customer', CustomerController::class);
Route::apiResource('inventorylevels', InventoryLevelsController::class);
Route::apiResource('inventoryorderhistory', InventoryOrderHistoryController::class);
Route::apiResource('menu', MenuController::class);
Route::apiResource('order', OrderController::class);
Route::apiResource('orderitem', OrderItemController::class);
Route::apiResource('product', ProductController::class);
Route::apiResource('productcategory', ProductCategoryController::class);
Route::apiResource('productname', ProductNameController::class);
Route::apiResource('reservation', ReservationController::class);
Route::apiResource('restauranttable', RestaurantTableController::class);
Route::apiResource('waiter', WaiterController::class);
