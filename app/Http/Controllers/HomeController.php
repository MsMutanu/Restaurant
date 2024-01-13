<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\RestaurantTables;
use App\Models\Slider;
use App\Models\Category;
use App\Models\UserOrder;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    public function index()
    {

        $categorys = Category::all();
        $items = Item::all();
        $tables = RestaurantTables::all();

        //$item = Item::where('category_id', Category::category()->id)->get();

         return view('fontend.index', compact('tables', 'categorys','items'));
    }
    public function contact()
    {
         return view('fontend.contact');
    }
    public function reservation()
    {
     $tables= RestaurantTables::all();
        return view('fontend.reservation', compact('tables'));
    }
    public function about()
    {
         return view('fontend.about');
    }
    public function blog()
    {
         return view('fontend.blog');
    }
    public function blogsingle()
    {
         return view('fontend.blogsingle');
    }


    public function menu()
{
    $products = Item::orderBy('created_at', 'DESC')->get()->take(8);
    $categories = Category::all();
    $userOrder = UserOrder::where('user_id', Auth::id())->where('status', 'cart')->first();

    // if (!$userOrder) {
    //     $cartItems = []; // If no cart is found, initialize an empty array.
    //     $cartTotal = 0;
    // } else {
        // Get the items in the cart along with their quantity
        $cartItems = $userOrder->items;

        // Calculate the total cost by looping through the items
        $cartTotal = 0;
        foreach ($cartItems as $item) {
            $cartTotal += $item->price * $item->pivot->quantity;
        }

    //dd($cartItems);

    return view('fontend.menu', compact('categories', 'cartItems', 'cartTotal'));
}



    public function services()
    {
        $carts = Cart::all();
        $items = Item::all();
        return view('fontend.services', compact('carts','items'));
    }
    public function shop()
    {
          $products = Item::orderBy('created_at','DESC')->get()->take(8);
         $categories = Category::all();
         return view('fontend.shop', compact('categories'));

    }

    public function productsingle()
    {
        $sliders = Slider::all();
        $categorys = Category::all();
        $items = Item::all();
        return view('fontend.product-single', compact('sliders', 'categorys','items'));

    }



}
