<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\UserOrder;
use Auth;

class CartController extends Controller
{

    public function createCart(Request $request)
    {
        // Check if the user already has an active cart
        $cart = Cart::where('user_id', Auth::id())->where('status', 'active')->first();

        // If no active cart found, create a new one
        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = Auth::id();
            $cart->status = 'active';
            $cart->save();
        }

        return redirect()->route('fontend.menu'); // Redirect to the menu page
    }

    public function addItemToCart(Request $request)
    {
       // Find the user's active cart (UserOrder with a 'cart' status)
    $userOrder = UserOrder::where('user_id', Auth::id())->where('status', 'cart')->first();

    // If the cart doesn't exist, create a new one
    if (!$userOrder) {
        $userOrder = new UserOrder();
        $userOrder->user_id = Auth::id();
        $userOrder->status = 'cart';
        $userOrder->save();
    }

    $item = Item::find($request->item_id);

    // Check if the item already exists in the user's cart
    $existingCartItem = $userOrder->items()->where('item_id', $item->id)->first();

    if ($existingCartItem) {
        // If the item already exists, update the quantity
        $existingCartItem->pivot->quantity += $request->quantity;
        $existingCartItem->pivot->save();
    } else {
        // If the item doesn't exist, attach it to the user's cart
        $userOrder->items()->attach($item->id, ['quantity' => $request->quantity]);
    }


        return redirect()->route('fontend.menu'); // Redirect back to the menu page
    }


    public function checkoutCart(Request $request)
    {
        // Get the user's active cart (UserOrder with a 'cart' status)
        $userOrder = UserOrder::where('user_id', Auth::id())->where('status', 'cart')->first();

        if (!$userOrder) {
            return redirect()->route('fontend.carts')->with('error', 'Your cart is empty. Please add items before checking out.');
        }

        // Calculate subtotal, tax, and total
        $subtotal = 0;
        foreach ($userOrder->items as $item) {
            $subtotal += $item->price * $item->pivot->quantity;
        }

        // You can calculate tax here or retrieve it from somewhere
        $tax = 0.1; // Replace with your tax calculation logic

        $total = $subtotal + $tax;

        // Update order details
        $userOrder->update([
            'status' => 'ordered',
            'order_payment_status' => 'Pending Payment',
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'payment_method' => $request->input('payment_method'),
        ]);



        return redirect()->route('fontend.index')->with('message', 'Order placed successfully.');
    }


    public function updateItem(Request $request)
{
    // Find the user's active cart (UserOrder with a 'cart' status)
    $userOrder = UserOrder::where('user_id', Auth::id())->where('status', 'cart')->first();

    if (!$userOrder) {
        return back()->with('error', 'Cart not found.');
    }

    $item = Item::find($request->item_id);

    // Check if the item already exists in the user's cart
    $existingCartItem = $userOrder->items()->where('item_id', $item->id)->first();

    if (!$existingCartItem) {
        return back()->with('error', 'Item not found in the cart.');
    }

    // Update the quantity of the item in the cart
    $existingCartItem->pivot->quantity = $request->quantity;
    $existingCartItem->pivot->save();

    return back()->with('success', 'Item quantity updated successfully.');
}

public function removeItem(Request $request)
{
    // Find the user's active cart (UserOrder with a 'cart' status)
    $userOrder = UserOrder::where('user_id', Auth::id())->where('status', 'cart')->first();

    if (!$userOrder) {
        return back()->with('error', 'Cart not found.');
    }

    $item = Item::find($request->item_id);

    // Detach the item from the user's cart
    $userOrder->items()->detach($item->id);

    return back()->with('success', 'Item removed from the cart.');
}

public function viewCart()
{
    if(Auth()->user()){
        $items = Item::all();

    // Find the user's active cart (UserOrder with a 'cart' status)
    $userOrder = UserOrder::where('user_id', Auth::id())->where('status', 'cart')->first();

    if (!$userOrder) {
        return redirect()->route('fontend.menu')->with('error', 'Your cart is empty.');
    }

    return view('fontend.user.carts', compact('userOrder','items'));
}else{
    return redirect()->route('user.login');
    }
}


public function showCart()
{
    // Retrieve the user's active cart (UserOrder with a 'cart' status)
    $userOrder = UserOrder::where('user_id', Auth::id())->where('status', 'cart')->first();

    if (!$userOrder) {
        $cartItems = []; // If no cart is found, initialize an empty array.
        $cartTotal = 0;
    } else {
        // Get the items in the cart along with their quantity and item data
        $cartItems = $userOrder->items()
            ->withPivot('quantity')
            ->with('item') // Load the associated item data
            ->get();

        // Calculate the total cost by looping through the items
        $cartTotal = 0;
        foreach ($cartItems as $cartItem) {
            if ($cartItem->items) {
                $cartTotal += $cartItem->items->price * $cartItem->pivot->quantity;
            }
        }
    }


    return view('fontend.user.cart', compact('cartItems', 'cartTotal'));
}

}
