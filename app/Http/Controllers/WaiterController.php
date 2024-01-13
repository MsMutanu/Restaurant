<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\UserOrder;
use App\Models\Item;
use App\Models\RestaurantTables;
use Illuminate\Support\Facades\Auth;

class WaiterController extends Controller
{
    public function index()
{
    $waiterId = Auth::user()->id; // Get the current waiter's user ID

    // Count orders for the specific waiter in different statuses
    $inProgressOrders = UserOrder::where('status', 'inprogress')
        ->where('user_id', $waiterId)
        ->count();

    $orderedOrders = UserOrder::where('status', 'ordered')
        ->where('user_id', $waiterId)
        ->count();

    $readyForDeliveryOrders = UserOrder::where('status', 'ready')
        ->where('user_id', $waiterId)
        ->count();

    $completedOrders = UserOrder::where('status', 'completed')
        ->where('user_id', $waiterId)
        ->count();

        $orderCounts = [$orderedOrders, $inProgressOrders, $readyForDeliveryOrders, $completedOrders];


    return view('waiter.index', compact( 'orderedOrders', 'inProgressOrders','readyForDeliveryOrders', 'completedOrders','orderCounts'));
}

public function create()
{
    $restauranttables = RestaurantTables::all();
    $categories = Category::all();
    $menuItems = Item::orderBy('created_at', 'DESC')->get()->take(8);

    $userOrder = UserOrder::where('user_id', Auth::id())->where('status', 'cart')->first();

    if (!$userOrder) {
        $cartItems = []; // If no cart is found, initialize an empty array.
        $cartTotal = 0;
    } else {
        // Get the items in the cart along with their quantity
        $cartItems = $userOrder->items;

        // Calculate the total cost by looping through the items
        $cartTotal = 0;
        foreach ($cartItems as $item) {
            $cartTotal += $item->price * $item->pivot->quantity;
        }
    }
    //dd($cartItems);

    return view('waiter.create', compact( 'cartItems', 'cartTotal','restauranttables', 'categories', 'menuItems'));
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
     return redirect()->route('waiter.create');



}

    public function createOrder(Request $request)
{
    // Get the user's active cart (UserOrder with a 'cart' status)
    $userOrder = UserOrder::where('user_id', Auth::id())->where('status', 'cart')->first();

    if (!$userOrder) {
        return redirect()->route('waiter.create')->with('error', 'Your cart is empty. Please add items before checking out.');
    }


    // Calculate subtotal, tax, and total
    $subtotal = 0;
    foreach ($userOrder->items as $item) {
        $subtotal += $item->price * $item->pivot->quantity;
    }


    $tax = 0.1;

    $total = $subtotal + $tax;

    // Update order details
    $userOrder->update([
        'status' => 'ordered',
        'order_payment_status' => 'Pending Payment',
        'subtotal' => $subtotal,
        'tax' => $tax,
        'total' => $total,
        'firstname' => $request->input('firstname'),
        'table_id'=>$request->input('table_id'),
        'payment_method' => $request->input('payment_method'),
    ]);



    return redirect()->route('waiter.ordered', $userOrder->id)->with('message', 'Order created.');
}


    public function assignOrder(Request $request, $orderId)
    {
        // Assign orders to specific tables
        $order = UserOrder::find($orderId);
        $order->table_id = $request->input('table_id');
        $order->save();

        return redirect()->route('waiter.viewOrder', $orderId)->with('message', 'Order assigned to a table.');
    }

    public function viewOrder($orderId)
    {
        // View order details
        $order = UserOrder::find($orderId);

        return view('waiter.orders.show', compact('order'));
    }

    public function editOrder($orderId)
    {
        // Edit orders only if the order is in "ordered" status
        $order = UserOrder::find($orderId);

        if ($order && $order->status === 'ordered') {
            return view('waiter.orders.edit', compact('order'));
        } else {
            return redirect()->route('waiter.viewOrder', $orderId)->with('error', 'You can only edit orders in "ordered" status.');
        }
    }


    public function updatePaymentStatus(UserOrder $order)
    {
        // Update payment status for orders
        // $order = UserOrder::find($orderId);
        $order->update(['payment_method' => 'Pending']);
        $order->update(['order_payment_status' => 'Paid']);


        return redirect()->route('waiter.completed')->with('message', 'Payment status updated.');
    }
    public function orderedOrders()
{
    $waiterId = Auth::user()->id;
    // Retrieve orders with status 'ordered'
    $orders = UserOrder::where('status', 'ordered')->where('user_id', $waiterId)->get();

    return view('waiter.orders.ordered', compact('orders'));
}

public function inProgressOrders()
{
    $waiterId = Auth::user()->id;
    // Retrieve orders with status 'in progress'
    $orders = UserOrder::where('status', 'inprogress')->where('user_id', $waiterId)->get();

    return view('waiter.orders.inprogress', compact('orders'));
}

public function readyForDeliveryOrders()
{
    $waiterId = Auth::user()->id;
    // Retrieve orders with status 'ready for delivery'
    $orders = UserOrder::where('status', 'ready')->where('user_id', $waiterId)->get();

    return view('waiter.orders.ready', compact('orders'));
}

public function completedOrders()
{
    $waiterId = Auth::user()->id;
    // Retrieve orders with status 'completed'
    $orders = UserOrder::where('status', 'completed')->where('user_id', $waiterId)->get();

    return view('waiter.orders.completed', compact('orders'));
}
public function viewTables()
    {
        $restauranttables = RestaurantTables::all();
        return view('waiter.tables', compact('restauranttables'));
    }
public function TableAvailable( RestaurantTables $restauranttable)
    {
       $restauranttable->update(['status' => 'available']);
        return redirect()->route('waiter.tables')->with('success', 'Table updated successfully');
    }
    public function TableUnavailable( RestaurantTables $restauranttable)
    {
       $restauranttable->update(['status' => 'unavailable']);
        return redirect()->route('waiter.tables')->with('success', 'Table updated successfully');
    }

    public function markOrderCompleted(UserOrder $order)
    {
        $order->update(['status' => 'completed']);

    return redirect()->route('waiter.ready')->with('success', 'Order marked as "Completef"');
    }

}
