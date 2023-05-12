<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function store(Request $request)
    {
        $order = new Order;
        $order->cust_id = $request->cust_id;
        $order->resttable_no = $request->resttable_no;
        $order->waiter_no = $request->waiter_no;
        $order->status = 'pending';
        $order->order_amount = 0;
        $order->save();

        return $order;
    }

    public function show($id)
    {
        return Order::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());

        return $order;
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return 204;
    }
}
