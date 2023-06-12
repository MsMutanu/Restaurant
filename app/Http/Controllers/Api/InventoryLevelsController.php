<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\InventoryLevel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InventoryLevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $inventoryLevels = InventoryLevel::all();
        return response()->json($inventoryLevels);
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
        'inventory_id' => 'required|string|max:255',
        'product_id' => 'required|exists:Product,product_id',
        'instock_quantity' => 'required|integer',
    ];

    // Validate the request data
    $validator = Validator::make($request->all(), $rules);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    // Validation passed, create the inventory level
    $inventoryLevel = new InventoryLevel;
    $inventoryLevel->inventory_id = 'STOCK' . Str::random(4); // Generate a random string with 4 characters
    $inventoryLevel->product_id = $request->input('product_id');
    $inventoryLevel->instock_quantity = $request->input('instock_quantity');
    
    // Check if the product_id corresponds to an existing product
    $existingProduct = Product::find($inventoryLevel->product_id);
    if (!$existingProduct) {
        return response()->json(['error' => 'Invalid product_id'], 400);
    }

    $inventoryLevel->save();

    return response()->json($inventoryLevel, 201);
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $inventoryLevel = InventoryLevel::findOrFail($id);
        return response()->json($inventoryLevel);
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
            'inventory_id' => 'string|max:255',
            'product_id' => 'string|max:50',
            'instock_quantity' => 'integer',
        ]);

        $inventoryLevel = InventoryLevel::findOrFail($id);
        $inventoryLevel->update($validatedData);

        return response()->json($inventoryLevel, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $inventoryLevel = InventoryLevel::findOrFail($id);
        $inventoryLevel->delete();

        return response()->json(null, 204);
    }
}
