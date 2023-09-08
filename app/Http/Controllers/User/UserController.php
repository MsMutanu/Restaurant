<?php

namespace App\Http\Controllers\User;


use App\Models\RestaurantTables;

use App\Models\Cart;
use App\Models\Item; 
use App\Models\Category;
use App\Models\Userorder; 
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
        $ordercount = Userorder::where('id', Auth::user()->id)->count();
        $carts = Cart::all();
        $cartcount = Cart::where('id', Auth::user()->id)->count();
        $userorders = Userorder::all();
        $item = Item::all();
        return view('fontend.user.profile', compact('userorders','carts','ordercount','cartcount'));   
    }




    public function cart()
    {
        $carts = Cart::all();
        $items = Item::all();
        return view('fontend.cart', compact('carts','items'));
    }



    public function checkout()
    {
        
        $categorys = Category::all();
        $items = Item::all();
        $restauranttables = RestaurantTables::all();

    return view('fontend.checkout', compact('categorys', 'items', 'restauranttables'));
}
     
    public function staying()
    {         
         return view('fontend.staying');   
    }


}
