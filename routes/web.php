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
use App\Http\Controllers\ProductNamesController;
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

//Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');

Auth::routes();

// Auth protected web routes

Route::group(['middleware' => ['web', 'auth']], function () {

  Route::get('home', 'HomeController@index')->name('home');

});

// Auth protected API routes

Route::middleware('auth:api')->group( function(){

Route::get('/admin/productnames', [ProductNamesController::class, 'index'])->name('productnames.index');
Route::get('/admin/productnames/create', [ProductNamesController::class, 'create'])->name('productnames.create');
Route::post('/admin/productnames', [ProductNamesController::class, 'store'])->name('productnames.store');
Route::get('/admin/productnames/{name_id}', [ProductNamesController::class, 'show'])->name('productnames.show');
Route::get('/admin/productnames/{name_id}/edit', [ProductNamesController::class, 'edit'])->name('productnames.edit');
Route::put('/admin/productnames/{name_id}', [ProductNamesController::class, 'update'])->name('productnames.update');
Route::delete('/admin/productnames/{name_id}', [ProductNamesController::class, 'destroy'])->name('productnames.destroy');

Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/admin/products/{product_id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/admin/products/{product_id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/admin/products/{product_id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/productcategory', [ProductCategoryController::class, 'index'])->name('admin.productcategory.index');
Route::get('/admin/productcategory/create', [ProductCategoryController::class, 'create'])->name('productcategory.create');
Route::post('/admin/productcategory', [ProductCategoryController::class, 'store'])->name('admin.productcategory.store');
Route::get('/admin/productcategory/{category_id}/edit', [ProductCategoryController::class, 'edit'])->name('productcategory.edit');
Route::put('/admin/productcategory/{category_id}', [ProductCategoryController::class, 'update'])->name('admin.productcategory.update');
Route::delete('/admin/productcategory/{category_id}', [ProductCategoryController::class, 'destroy'])->name('admin.productcategory.destroy');
Route::get('/admin/productcategory/{category_id}', [ProductCategoryController::class, 'show'])->name('admin.productcategory.show');

});