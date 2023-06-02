<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\InventoryOrderHistory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InventoryOrderHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'product_id' => 'required|exists:Product,product_id',
            'datetime_ordered' => 'required',
            'amount' => 'required|integer'
        ];

        // Validate the request data
    $validator = Validator::make($request->all(), $rules);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }   
        $inventoryOrderHistory = new InventoryOrderHistory;
        $inventoryOrderHistory-> invorder_id = 'INV'. Str::random(4);
        $inventoryOrderHistory-> product_id = $request->input('product_id');
        $inventoryOrderHistory->amount = $request->input('amount');

 // Check if the product_id corresponds to an existing product
 $existingProduct = Product::find($inventoryOrderHistory->product_id);
 if (!$existingProduct) {
     return response()->json(['error' => 'Invalid product_id'], 400);
 }
        $inventoryOrderHistory->save();
        
        return response()->json($inventoryOrderHistory, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $inventoryOrderHistory = InventoryOrderHistory::findOrFail($id);
        $inventoryOrderHistory->delete();
        return response()->json(null, 204);
    }
}
