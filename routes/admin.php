<?php

use App\Http\Controllers\Admin\RestaurantTablesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubitemController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\UserController;
 
Auth::routes(['verify'=>true]);
   
 //admin dashboard controller route
Route::group(['prefix'=>'admin', 'middleware'=>'admin','verified' ], function(){
    //admin dashboard home route
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('slider', SliderController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('item', ItemController::class);
    Route::resource('subitem', SubitemController::class);
    Route::resource('reservation', ReservationController::class);
    Route::resource('restauranttables', RestaurantTablesController::class);
    //order list route
    Route::get('order', [App\Http\Controllers\Admin\UserOrderController::class, 'index'])->name('order.index');
    //order update / confirm
    Route::post('/update/{id}', [App\Http\Controllers\Admin\UserOrderController::class, 'update'])->name('order.update');  
    //order cancelOrder
    Route::post('/cancelOrder/{id}', [App\Http\Controllers\Admin\UserOrderController::class, 'cancelOrder'])->name('order.cancelOrder');  
    //order delete by admin
    Route::post('/delete/{id}', [App\Http\Controllers\Admin\UserOrderController::class, 'destroy'])->name('order.destroy');
    
    Route::resource('users', UserController::class);
    Route::get('/admin/users', [UserController::class,'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class,'create'])->name('admin.users.create');
    Route::get('/admin/users/{id}/edit', [UserController::class,'edit'])->name('admin.users.edit');
    Route::post('/admin/users/store', [UserController::class,'store'])->name('admin.users.store');
    Route::put('/admin/users/{id}', [UserController::class,'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [UserController::class,'destroy'])->name('admin.users.destroy');
    Route::get('/admin/users/show', [UserController::class,'show'])->name('admin.users.show');
});

 //admin login
   Route::get('wp-admin', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');
    

 // register sub-admin
   Route::get('subadmin', [App\Http\Controllers\Auth\RegisterController::class, 'subadmin'])->name('subadmin.register');
 // register sub-admin
   Route::post('subadmins', [App\Http\Controllers\Auth\RegisterController::class, 'subadmins'])->name('subadmins.register');
   
   Route::get('/admin/restauranttables', [App\Http\Controllers\Admin\RestaurantTablesController::class, 'index'])->name('restauranttables.index');
   Route::get('/admin/restauranttables/create', [App\Http\Controllers\Admin\RestaurantTablesController::class, 'create'])->name('restauranttables.create');    
Route::post('/admin/restauranttables/store', [App\Http\Controllers\Admin\RestaurantTablesController::class, 'store'])->name('admin.restauranttables.store');
Route::get('/admin/restauranttables/{id}/edit', [App\Http\Controllers\Admin\RestaurantTablesController::class, 'edit'])->name('admin.restauranttables.edit');
Route::put('/admin/restauranttables/{id}', [App\Http\Controllers\Admin\RestaurantTablesController::class, 'update'])->name('admin.restauranttables.update');
Route::delete('/admin/restauranttables/{id}', [App\Http\Controllers\Admin\RestaurantTablesController::class, 'destroy'])->name('admin.restauranttables.destroy');


 