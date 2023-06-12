<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantTable;
use Illuminate\Support\Str;

class RestaurantTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tables = RestaurantTable::all();
        return response()->json($tables, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'resttable_no' => 'required|integer',
            'availability' => 'required',
            'capacity' => 'required|integer',
        ]);

        $table = new RestaurantTable;
        $table->resttable_id = 'TAB'. Str::random(4);
        $table-> resttable_no = $request->input('resttable_no');
        $table->availability = $request->input('availability');
        $table ->capacity = $request ->input('capacity');
        $table->save();
        
        return response()->json($table, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $table = RestaurantTable::findOrFail($id);
        return response()->json($table, 200);
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
            'resttable_no' => 'required|integer',
            'availability' => 'required',
            'capacity' => 'required|integer',
        ]);

        $table = RestaurantTable::findOrFail($id);
        $table->update($validatedData);
        return response()->json([
            'message'=> 'Table Updated Successfuly',
            'table' => $table, 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $table = RestaurantTable::findOrFail($id);
        $table->delete();
        return response()->json([
            'message'=> 'Table deleted', 204]);
    }
}
