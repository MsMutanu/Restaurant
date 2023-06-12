<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Summary of BillController
 */
class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $bills = Bill::all();
        return response()->json($bills, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'cust_id' => 'required|exists:Customer,cust_id',
            'order_id' => 'required|exists:Order,order_id',
            'resttable_no' => 'required',
            'waiter_no' => 'required',
            'total' => 'required'
        ];
    
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Validation passed, create the bill    
        $bill = new Bill;
    $bill->bill_id =  'Bill' .Str::random(4); // Generate a random string with 4 characters
    $bill->cust_id = $request->input('cust_id');
    $bill->order_id = $request->input('order_id');
    $bill->resttable_no = $request->input('resttable_no');
    $bill->waiter_no = $request->input('waiter_no');
    $bill->total = $request->input('total');

    // Check if the order_id corresponds to an existing order
    $existingOrder = Order::find($bill->order_id);
    if (!$existingOrder) {
        return response()->json(['error' => 'Invalid order_id'], 400);
    }

    // Check if the cust_id corresponds to an existing customer
    $existingCustomer = Customer::find($bill->cust_id);
    if (!$existingCustomer) {
        return response()->json(['error' => 'Invalid cust_id'], 400);
    }
    
    $bill->save();

        return response()->json($bill, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $bill = Bill::findOrFail($id);
        return response()->json($bill, 200);
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
            'order_id' => 'required',
            'resttable_no' => 'required',
            'waiter_no' => 'required',
            'total' => 'required'
        ]);

        $bill = Bill::findOrFail($id);
        $bill->update($validatedData);
        return response()->json([
            'message' => 'Bill updated successfully',
            'bill' => $bill,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->delete();
        return response()->json([
            'message' => 'Bill deleted successfully',
        ]);
    }
}
