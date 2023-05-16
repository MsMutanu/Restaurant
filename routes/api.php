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

Route::resource('bill', BillController::class);
Route::resource('customer', CustomerController::class);
Route::resource('inventorylevels', InventoryLevelsController::class);
Route::resource('inventoryorderhistory', InventoryOrderHistoryController::class);
Route::resource('menu', MenuController::class);
Route::resource('order', OrderController::class);
Route::resource('orderitem', OrderItemController::class);
Route::resource('product', ProductController::class);
Route::resource('productcategory', ProductCategoryController::class);
Route::resource('productname', ProductNameController::class);
Route::resource('reservation', ReservationController::class);
Route::resource('restauranttable', RestaurantTableController::class);
Route::resource('waiter', WaiterController::class);
