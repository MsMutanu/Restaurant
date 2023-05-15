<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryLevel;
use Illuminate\Http\Response;

class InventoryLevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'inventory_id' => 'required|string|max:255',
            'product_id' => 'required|string|max:50',
            'instock_quantity' => 'required|integer',
        ]);

        $inventoryLevel = InventoryLevel::create($validatedData);

        return response()->json($inventoryLevel, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventoryLevel = InventoryLevel::findOrFail($id);
        $inventoryLevel->delete();

        return response()->json(null, 204);
    }
}
