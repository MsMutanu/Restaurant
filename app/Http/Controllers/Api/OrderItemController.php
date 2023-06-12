<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $orderItems = OrderItem::all();
        return response()->json($orderItems, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Define the validation rules
    $rules = [
        'order_id' => 'required|exists:Order,order_id',
        'product_id' => 'required|exists:Product,product_id',
        ];

         // Validate the request data
    $validator = Validator::make($request->all(), $rules);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

        $orderItem = new OrderItem;
        $orderItem->orderitems_id = 'Item'. Str::random(4);
        $orderItem-> order_id = $request->input('order_id');
        $orderItem->product_id = $request->input('product_id');
        
     // Check if the product_id corresponds to an existing product
     $existingProduct = Product::find($orderItem->product_id);
     if (!$existingProduct) {
         return response()->json(['error' => 'Invalid product_id'], 400);
     }

      // Check if the order_id corresponds to an existing order
    $existingOrder = Order::find($orderItem->order_id);
    if (!$existingOrder) {
        return response()->json(['error' => 'Invalid order_id'], 400);
    }

        $orderItem->save();

        return response()->json($orderItem, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        return response()->json($orderItem, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
        ]);

        $orderItem = OrderItem::findOrFail($id);
        $orderItem->update($validatedData);
        return response()->json($orderItem, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();
        return response()->json(null, 204);
    }
}
