<?php

use Illuminate\Support\Facades\Route;



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

Route::get('/bills', 'App\Http\Controllers\BillController@index');
Route::get('/bills/{id}', 'App\Http\Controllers\BillController@show');
Route::post('/bills', 'App\Http\Controllers\BillController@store');
Route::put('/bills/{id}', 'App\Http\Controllers\BillController@update');
Route::delete('/bills/{id}', 'App\HttpControllers\BillController@destroy');

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{id}', [CustomerController::class, 'show']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::put('/customers/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

Route::get('/inventorylevels', 'App\Http\Controllers\InventoryLevelsController@index');
Route::get('/inventorylevels/create', 'App\Http\Controllers\InventoryLevelsController@create');
Route::post('/inventorylevels', 'App\Http\Controllers\InventoryLevelsController@store');
Route::get('/inventorylevels/{id}', 'App\Http\Controllers\InventoryLevelsController@show');
Route::get('/inventorylevels/{id}/edit', 'App\Http\Controllers\InventoryLevelsController@edit');
Route::put('/inventorylevels/{id}', 'App\Http\Controllers\InventoryLevelsController@update');
Route::delete('/inventorylevels/{id}', 'App\Http\Controllers\InventoryLevelsController@destroy');



Route::get('/orders', 'OrderController@index');
Route::post('/orders', 'OrderController@store');
Route::get('/orders/{id}', 'OrderController@show');
Route::put('/orders/{id}', 'OrderController@update');
Route::delete('/orders/{id}', 'OrderController@destroy');

 
