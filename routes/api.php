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

Route::resource('Bill', BillController::class);
Route::resource('Customer', CustomerController::class);
Route::resource('InventoryLevel', InventoryLevelsController::class);
Route::resource('InventoryOrderHistory', InventoryOrderHistoryController::class);
Route::resource('Menu', MenuController::class);
Route::resource('Order', OrderController::class);
Route::resource('OrderItem', OrderItemController::class);
Route::resource('Product', ProductController::class);
Route::resource('ProductCategory', ProductCategoryController::class);
Route::resource('ProductName', ProductNameController::class);
Route::resource('Reservation', ReservationController::class);
Route::resource('RestaurantTable', RestaurantTableController::class);
Route::resource('Waiter', WaiterController::class);
