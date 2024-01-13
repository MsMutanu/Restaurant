<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('fontend.index');
});

Auth::routes(['verify'=>true]);

// fontend all pages route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('fontend.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('fontend.index');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('fontend.contact');
Route::get('/reservation', [App\Http\Controllers\HomeController::class, 'reservation'])->name('fontend.reservation');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('fontend.about');
Route::get('/cart', [App\Http\Controllers\User\UserController::class, 'cart'])->name('fontend.carts');
Route::get('/menu', [App\Http\Controllers\HomeController::class, 'menu'])->name('fontend.menu');
Route::get('/shop', [App\Http\Controllers\HomeController::class, 'shop'])->name('fontend.shop');
Route::get('/checkout', [App\Http\Controllers\User\UserController::class, 'checkout'])->name('fontend.checkout');
Route::post('/order', [App\Http\Controllers\User\CartController::class, 'checkoutCart'])->name('confirm.order');
Route::get('/productsingle', [App\Http\Controllers\HomeController::class, 'productsingle'])->name('fontend.productsingle');
Route::get('/staying', [App\Http\Controllers\User\UserController::class, 'staying'])->name('fontend.staying');

//user product view
Route::get('/viewproduct/{id}', [App\Http\Controllers\ViewproductController::class, 'viewproduct'])->name('fontend.viewproduct');

Route::group(['prefix'=>'user', 'middleware'=>'user','verified'], function(){
    //user profile
    Route::get('/profile', [App\Http\Controllers\User\UserController::class, 'profile'])->name('fontend.profile');

    //user view order
    Route::get('/myorder', [App\Http\Controllers\User\OrderController::class, 'myorder'])->name('fontend.myorder');

    //user view order
    //Route::get('/cart', [App\Http\Controllers\User\CartController::class, 'carts'])->name('fontend.cart');

    //user Sent product Order
    Route::post('order', [App\Http\Controllers\Admin\UserOrderController::class, 'store'])->name('order.store');

  });

use App\Http\Controllers\User\CartController;

Route::prefix('carts')->group(function () {
    // Show the cart
    Route::get('/', [CartController::class, 'index'])->name('cart.index');

    // Add an item to the cart
    Route::post('/add', [CartController::class, 'addItemToCart'])->name('cart.add');


    Route::get('/showcart', [CartController::class, 'viewCart'])->name('cart.show');

    Route::get('/cartCard', [CartController::class, 'showCart'])->name('fontend.cart');

    // Update the quantity of an item in the cart
    Route::put('/update/{cart}', [CartController::class, 'updateItem'])->name('cart.update');

    // Remove an item from the cart
    Route::delete('/remove/{cart}', [CartController::class, 'removeItem'])->name('cart.remove');
});


//route group
// Route::group(['namespace'=> 'App\Http\Controllers\User', 'middleware'=>'user','verified'], function(){

//     Route::get('/addcart', 'CartController@index')->name('fontend.cart');
//     Route::resource('carts', CartController::class);



// });


//user login
Route::get('/user-login', [App\Http\Controllers\Auth\LoginController::class, 'userLogin'])->name('user.login');
//user login
Route::post('/users-login', [App\Http\Controllers\Auth\LoginController::class, 'usersLogin'])->name('userslogin');
//user invalid click return logout
Route::get('/invalid_click', [App\Http\Controllers\Auth\LoginController::class, 'invalid'])->name('invalid');

//admin login
Route::get('/admin-login',[App\Http\Controllers\Auth\LoginController::class, 'adminLogin']) ->name('admin.login');



// reservation table route
Route::post('/reservation', [App\Http\Controllers\User\ReservationController::class, 'sentReservation'])->name('sentReservation');

// contact form route by email system
Route::post('/contuct', [App\Http\Controllers\ContactController::class, 'contuct'])->name('contuct');
Route::post('/sendEmail', [App\Http\Controllers\ContactController::class, 'sendEmail'])->name('sendEmail');


Route::group(['middleware' => 'auth'], function () {
    // Routes accessible by all authenticated users

    Route::group(['middleware' => 'kitchen-staff'], function () {
        // Routes accessible by kitchen staff
        Route::prefix('kitchen')->group(function () {
            Route::get('/',  [App\Http\Controllers\KitchenController::class, 'index'])->name('kitchen.index');
            Route::get('/incomingOrders',  [App\Http\Controllers\KitchenController::class, 'incomingOrders'])->name('kitchen.orders.incoming');
            Route::get('/inprogress',  [App\Http\Controllers\KitchenController::class, 'inProgressOrders'])->name('kitchen.orders.inprogress');
            Route::get('/readyOrders',  [App\Http\Controllers\KitchenController::class, 'readyOrders'])->name('kitchen.orders.ready');
            Route::get('/orders/{orderId}', [App\Http\Controllers\KitchenController::class, 'show'])->name('kitchen.show');
            Route::post('/orders/{orderId}', [App\Http\Controllers\KitchenController::class, 'updateStatus'])->name('kitchen.updateStatus');
            Route::get('/inventory', [App\Http\Controllers\KitchenController::class, 'inventoryManagement'])->name('kitchen.inventory');
            Route::post('/inventory/{item}', [App\Http\Controllers\KitchenController::class, 'updateMenuItemAvailability'])->name('kitchen.updateMenuItemAvailability');
            Route::post('/orders/{orderId}/update', [App\Http\Controllers\KitchenController::class, 'updateOrder'])->name('kitchen.updateOrder');
            Route::patch('/orders/markReady/{order}', [App\Http\Controllers\KitchenController::class, 'markOrderAsReady'])->name('kitchen.orders.markReady');
            Route::patch('/orders/markInProgress/{order}', [App\Http\Controllers\KitchenController::class,'markOrderAsInProgress'])->name('kitchen.orders.markInProgress');
            Route::get('/edit/{item}', [App\Http\Controllers\KitchenController::class, 'edit'])->name('kitchen.edit');



        });

    });

    Route::group(['middleware' => 'waiter'], function () {
        // Routes accessible by waiters
        Route::prefix('waiter')->group(function () {
            Route::get('/', [App\Http\Controllers\WaiterController::class, 'index'])->name('waiter.index');
            Route::get('/orders/create', [App\Http\Controllers\WaiterController::class, 'createOrder'])->name('waiter.createOrder');
            Route::get('/orders', [App\Http\Controllers\WaiterController::class, 'viewOrders'])->name('waiter.viewOrders');
            Route::put('/orders/{orderId}/assign',  [App\Http\Controllers\WaiterController::class, 'assignOrder'])->name('waiter.assignOrder');
            Route::get('/orders/{orderId}/edit',  [App\Http\Controllers\WaiterController::class, 'editOrder'])->name('waiter.editOrder');
            Route::patch('/orders/update-payment/{order}',  [App\Http\Controllers\WaiterController::class, 'updatePaymentStatus'])->name('waiter.updatePayment');
            Route::get('/tables', [App\Http\Controllers\WaiterController::class, 'viewTables'])->name('waiter.tables');
            Route::patch('/tableAvailable/{restauranttable}', [App\Http\Controllers\WaiterController::class, 'TableAvailable'])->name('waiter.TableAvailable');
            Route::patch('/tableUnavailable/{restauranttable}', [App\Http\Controllers\WaiterController::class, 'TableUnavailable'])->name('waiter.TableUnavailable');
            Route::get('/create', [App\Http\Controllers\WaiterController::class, 'create'])->name('waiter.create');
            Route::post('/add/toCart', [App\Http\Controllers\WaiterController::class,'addItemToCart'])->name('waiter.addToCart');
            Route::post('/createOrder', [App\Http\Controllers\WaiterController::class, 'createOrder'])->name('waiter.createOrder');
            Route::patch('/orders/markCompleted/{order}', [App\Http\Controllers\WaiterController::class,'markOrderCompleted'])->name('waiter.orders.markCompleted');


            // Routes for viewing orders based on status
            Route::get('/orders/ordered',  [App\Http\Controllers\WaiterController::class, 'orderedOrders'])->name('waiter.ordered');
            Route::get('/orders/inprogress',  [App\Http\Controllers\WaiterController::class, 'inProgressOrders'])->name('waiter.inprogress');
            Route::get('/orders/ready',  [App\Http\Controllers\WaiterController::class, 'readyForDeliveryOrders'])->name('waiter.ready');
            Route::get('/orders/completed',  [App\Http\Controllers\WaiterController::class, 'completedOrders'])->name('waiter.completed');
        });


    });


});
