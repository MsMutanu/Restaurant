<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use Illuminate\Http\Response;


class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::all();
        return response()->json($bills);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bill = new Bill;
        $bill->cust_id = $request->input('cust_id');
        $bill->order_id = $request->input('order_id');
        $bill->resttable_no = $request->input('resttable_no');
        $bill->waiter_no = $request->input('waiter_no');
        $bill->save();

        return response()->json($bill);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bill::find($id);
        if (!$bill) {
            return response()->json(['error' => 'Bill not found'], 404);
        }
        return response()->json($bill);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bill = Bill::find($id);
        if (!$bill) {
            return response()->json(['error' => 'Bill not found'], 404);
        }
        $bill->cust_id = $request->input('cust_id');
        $bill->order_id = $request->input('order_id');
        $bill->resttable_no = $request->input('resttable_no');
        $bill->waiter_no = $request->input('waiter_no');
        $bill->save();

        return response()->json($bill);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill = Bill::find($id);
        if (!$bill) {
            return response()->json(['error' => 'Bill not found'], 404);
        }
        $bill->delete();

        return response()->json(['message' => 'Bill deleted successfully']);
    }
}
