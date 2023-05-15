<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryOrderHistory;

class InventoryOrderHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventoryOrderHistory = InventoryOrderHistory::all();
        return response()->json($inventoryOrderHistory, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'datetime_ordered' => 'required',
            'amount' => 'required|integer'
        ]);
        
        $inventoryOrderHistory = InventoryOrderHistory::create($validatedData);
        return response()->json($inventoryOrderHistory, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventoryOrderHistory = InventoryOrderHistory::findOrFail($id);
        return response()->json($inventoryOrderHistory, 200);
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
        $validatedData = $request->validate([
            'product_id' => 'required',
            'datetime_ordered' => 'required',
            'amount' => 'required|integer'
        ]);

        $inventoryOrderHistory = InventoryOrderHistory::findOrFail($id);
        $inventoryOrderHistory->update($validatedData);
        return response()->json($inventoryOrderHistory, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventoryOrderHistory = InventoryOrderHistory::findOrFail($id);
        $inventoryOrderHistory->delete();
        return response()->json(null, 204);
    }
}
