<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InventoryLevelsController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductNameController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RestaurantTableController;
use App\Http\Controllers\WaiterController;
use App\Http\Controllers\InventoryOrderHistoryController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/bill', [BillController::class,'index']);
// Route::get('/bill/{bill_id}', [BillController::class,'show']);
// Route::post('/newbill', [BillController::class,'store']);
// Route::put('/updatebill/{bill_id}', [BillController::class, 'update']);
// Route::delete('/deletebill/{bill_id}', [BillController::class,'destroy']);

// Route::get('/customer', [CustomerController::class, 'index']);
// Route::get('/customers/{cust_id}', [CustomerController::class, 'show']);
// Route::post('/newcustomer', [CustomerController::class, 'store']);
// Route::put('/updatecustomer/{cust_id}', [CustomerController::class, 'update']);
// Route::delete('/deletecustomer/{cust_id}', [CustomerController::class, 'destroy']);

// Route::get('/inventorylevels', [InventoryLevelsController::class,'index']);
// Route::post('/addinventorylevels', [InventoryLevelsController::class,'store']);
// Route::get('/inventorylevels/{inventory_id}', [InventoryLevelsController::class,'show']);
// Route::put('/updateinventorylevels/{inventory_id}', [InventoryLevelsController::class,'update']);
// Route::delete('/deleteinventorylevels/{inventory_id}', [InventoryLevelsController::class,'destroy']);


// Route::get('/order', [OrderController:: class, 'index']);
// Route::post('/neworder', [OrderController:: class, 'store']);
// Route::get('/order/{order_id}', [OrderController:: class, 'show']);
// Route::put('/updateorder/{order_id}', [OrderController:: class, 'update']);
// Route::delete('/deleteorder/{order_id}', [OrderController:: class, 'destroy']);

// Route::get('/customer', [CustomerController::class,'index']);
// Route::get('/customer/{cust_id}', [CustomerController::class,'show']);
// Route::post('/newcustomer', [CustomerController::class,'store']);
// Route::put('/updatecustomer/{cust_id}', [CustomerController::class, 'update']);
// Route::delete('/deletecustomer/{cust_id}', [CustomerController::class,'destroy']);

// Route::get('/invorder', [InventoryOrderHistoryController::class,'index']);
// Route::get('/invorder/{invorder_id}', [InventoryOrderHistoryController::class,'show']);
// Route::post('/newinvorder_id', [InventoryOrderHistoryController::class,'store']);
// Route::put('/updateinvorder/{invorder_id}', [InventoryOrderHistoryController::class, 'update']);
// Route::delete('/deleteinvorder/{invorder_id}', [InventoryOrderHistoryController::class,'destroy']);

// Route::get('/menu', [MenuController:: class, 'index']);
// Route::post('/newmenu', [MenuController:: class, 'store']);
// Route::get('/menu/{menu_id}', [MenuController:: class, 'show']);
// Route::put('/updatemenu/{menu_id}', [MenuController:: class, 'update']);
// Route::delete('/deletemenu/{menu_id}', [MenuController:: class, 'destroy']);

// Route::get('/orderitem', [OrderItemController:: class, 'index']);
// Route::post('/neworderitem', [OrderItemController:: class, 'store']);
// Route::get('/orderitem/{orderitems_id}', [OrderItemController:: class, 'show']);
// Route::put('/updateorderitem/{orderitems_id}', [OrderItemController:: class, 'update']);
// Route::delete('/deleteorderitem/{orderitems_id}', [OrderItemController:: class, 'destroy']);

// Route::get('/product', [ProductController:: class, 'index']);
// Route::post('/newproduct', [ProductController:: class, 'store']);
// Route::get('/product/{product_id}', [ProductController:: class, 'show']);
// Route::put('/updateproduct/{product_id}', [ProductController:: class, 'update']);
// Route::delete('/deleteproduct/{product_id}', [ProductController:: class, 'destroy']);

// Route::get('/category', [ProductCategoryController:: class, 'index']);
// Route::post('/newcategory', [ProductCategoryController:: class, 'store']);
// Route::get('/category/{category_id}', [ProductCategoryController:: class, 'show']);
// Route::put('/updatecategory/{category_id}', [ProductCategoryController:: class, 'update']);
// Route::delete('/deletecategory/{category_id}', [ProductCategoryController:: class, 'destroy']);

// Route::get('/productname', [ProductNameController:: class, 'index']);
// Route::post('/newproductname', [ProductNameController:: class, 'store']);
// Route::get('/productname/{name_id}', [ProductNameController:: class, 'show']);
// Route::put('/updateproductname/{name_id}', [ProductNameController:: class, 'update']);
// Route::delete('/deleteproductname/{name_id}', [ProductNameController:: class, 'destroy']);

// Route::get('/reservation', [ReservationController:: class, 'index']);
// Route::post('/newreservation', [ReservationController:: class, 'store']);
// Route::get('/reservation/{reserve_id}', [ReservationController:: class, 'show']);
// Route::put('/updatereservation/{reserve_id}', [ReservationController:: class, 'update']);
// Route::delete('/deletereservation/{reserve_id}', [ReservationController:: class, 'destroy']);

// Route::get('/resttable', [RestaurantTableController:: class, 'index']);
// Route::post('/newresttable', [RestaurantTableController:: class, 'store']);
// Route::get('/resttable/{resttable_id}', [RestaurantTableController:: class, 'show']);
// Route::put('/updateresttable/{resttable_id}', [RestaurantTableController:: class, 'update']);
// Route::delete('/deleteresttable/{resttable_id}', [RestaurantTableController:: class, 'destroy']);


// Route::get('/waiter', [WaiterController:: class, 'index']);
// Route::post('/newwaiter', [WaiterController:: class, 'store']);
// Route::get('/waiter/{wait_id}', [WaiterController:: class, 'show']);
// Route::put('/updatewaiter/{wait_id}', [WaiterController:: class, 'update']);
// Route::delete('/deletewaiter/{wait_id}', [WaiterController:: class, 'destroy']);

