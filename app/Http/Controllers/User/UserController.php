<?php

namespace App\Http\Controllers\User;


use App\Models\RestaurantTables;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Category;
use App\Models\UserOrder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


     public function profile()
    {

        // count user order
        $ordercount = UserOrder::where('id', Auth::user()->id)->count();
        $carts = Cart::all();
        $cartcount = Cart::where('id', Auth::user()->id)->count();
        $userorders = UserOrder::all();
        $item = Item::all();
        return view('fontend.user.profile', compact('userorders','carts','ordercount','cartcount'));
    }




    // public function cart()
    // {
    //     $carts = Cart::all();
    //     $items = Item::all();
    //     return view('fontend.cart', compact('carts','items'));
    // }



    public function checkout()
    {

        $categorys = Category::all();
        $items = Item::all();
        $restauranttables = RestaurantTables::all();
        // Retrieve the user's active cart (UserOrder with a 'cart' status)
        $userOrder = UserOrder::where('user_id', Auth::id())->where('status', 'cart')->first();

    if (!$userOrder) {
        $cartItems = []; // If no cart is found, initialize an empty array.
        $cartTotal = 0;
    } else {
        // Get the items in the cart along with their quantity
        $cartItems = $userOrder->items()->withPivot('quantity')->get();

        // Calculate the total cost by looping through the items
        $cartTotal = 0;
        foreach ($cartItems as $item) {
            $cartTotal += $item->price * $item->pivot->quantity;
        }
    }


    return view('fontend.checkout', compact('categorys', 'items', 'restauranttables','cartTotal'));
}

    public function staying()
    {
         return view('fontend.staying');
    }


}
