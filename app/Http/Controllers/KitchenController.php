<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\UserOrder;
use App\Models\Item;

class KitchenController extends Controller
{
    public function index()
{
    $inProgress= UserOrder::where('status', 'inprogress')->count();

    $incomingOrders = UserOrder::where('status', 'ordered')->count();

    $readyOrders= UserOrder::where('status', 'ready')->count();

    $completedOrders= UserOrder::where('status', 'completed')->count();

    $lowStockItems = Item::where('in_stock', '<', 10)->get();

    return view('kitchen.index', compact( 'incomingOrders', 'inProgress','readyOrders', 'completedOrders', 'lowStockItems'));
}

    public function incomingOrders()
    {

        // View incoming orders
        $incomingOrders = UserOrder::where('status', 'ordered')->get();

        // Calculate time remaining for each incoming order
    foreach ($incomingOrders as $order) {
        // Calculate the time since the order was created
        $createdTime = strtotime($order->created_at);
        $currentTime = time();
        $timeElapsed = $currentTime - $createdTime;

        // Calculate the time remaining (in seconds)
        $timeRemaining = 600 - $timeElapsed; // 10 minutes = 600 seconds

        // Store the time remaining in the order object
        $order->timeRemaining = $timeRemaining;
    }

        return view('kitchen.orders.incoming', compact('incomingOrders'));
    }
    public function inProgressOrders()
    {
        $inProgress = UserOrder::where('status', 'inprogress')->get();

        return view('kitchen.orders.inprogress', compact('inProgress'));
    }
    public function readyOrders()
    {
        $readyOrders= UserOrder::where('status', 'ready')->get();

        return view ('kitchen.orders.ready', compact('readyOrders'));
    }

    public function show($orderId)
    {
        // Show order details
        $order = UserOrder::find($orderId);

        return view('kitchen.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $orderId)
    {
        // Mark orders as "in progress," "ready for delivery," or "completed"
        $order = UserOrder::find($orderId);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('kitchen.show', $orderId);
    }

    public function updateMenuItemAvailability(Request $request, $id)
    {
        $item = Item::findOrFail($id);

         // Validate the request data
    $request->validate([
        'in_stock' => 'required|integer', // Example validation rules, adjust as needed
        'availability' => 'required|boolean', // Make sure you include this validation
    ]);

    // Update the item with the provided data
    $item->in_stock = $request->input('in_stock');
    $item->availability = $request->input('availability');
    $item->save();

        return redirect()->route('kitchen.inventory')->with('message', 'Menu item availability updated.');
    }

    public function updateOrder(Request $request, $orderId)
    {
        // Update orders in case of modifications or substitutions


        $this->validate($request,[
            'status' => 'required'

        ]);

         $order = UserOrder::find($orderId);
         $order->status = $request->status;

         $order->save();


        return redirect()->route('kitchen.show', $orderId)->with('message', 'Order updated.');
    }



     public function inventoryManagement()
     {
        $menuItems = Item::all();
    return view('kitchen.inventory', compact('menuItems'));
    }
    public function markOrderAsReady(UserOrder $order)
{
    $order->update(['status' => 'ready']);

    return redirect()->route('kitchen.orders.inprogress')->with('success', 'Order marked as "Ready"');
}
public function markOrderAsInProgress(UserOrder $order)
{
    $order->update(['status' => 'inprogress']);

    return redirect()->route('kitchen.orders.incoming')->with('success', 'Order marked as "In Progress"');
}

public function edit($id)
{
    try {
        $item = Item::findOrFail($id); // Find the item by ID
        return view('kitchen.edit', compact('item'));
    } catch (ModelNotFoundException $exception) {
        return redirect()->route('kitchen.inventory')->with('error', 'Item not found.');
    }
}



}
