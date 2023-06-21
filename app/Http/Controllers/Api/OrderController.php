<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders, 200);
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
             'cust_id' => 'required|exists:Customer,cust_id',
             'resttable_no' => 'required',
             'status' => 'required',
             'order_amount' => 'required|numeric',
         ];
     
         // Validate the request data
         $validator = Validator::make($request->all(), $rules);
     
         // Check if validation fails
         if ($validator->fails()) {
             return response()->json(['errors' => $validator->errors()], 400);
         }
     
         // Validation passed, create the order
         $order = new Order;
         $order->order_id = 'Ord' . Str::random(4); // Generate a random string with 4 characters
         $order->cust_id = $request->input('cust_id');
         $order->resttable_no = $request->input('resttable_no');
         $order->status = $request->input('status');
         $order->order_amount = $request->input('order_amount');
     
         // Check if the cust_id corresponds to an existing customer
         $existingCustomer = Customer::find($order->cust_id);
         if (!$existingCustomer) {
             return response()->json(['error' => 'Invalid cust_id'], 400);
         }
     
         $order->save();
     
         return response()->json($order, 201);
     }
     


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order, 200);
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
            'cust_id' => 'required',
            'resttable_no' => 'required|integer',
            'date_time' => 'required|date',
            'status' => 'required',
            'order_amount' => 'required|numeric',
        ]);

        $order = Order::findOrFail($id);
        $order->update($validatedData);
        return response()->json($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json([
            'message' => 'Order deleted successfully',
        ]);
    }
}
