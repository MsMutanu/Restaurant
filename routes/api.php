<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryLevelsController;
use App\Http\Controllers\InventoryOrderHistoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductNameController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RestaurantTableController;
use App\Http\Controllers\WaiterController;

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
