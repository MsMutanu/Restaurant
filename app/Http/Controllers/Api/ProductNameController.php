<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductName;
use Illuminate\Support\Str;

class ProductNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $productNames = ProductName::all();
        return response()->json($productNames, 200);
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
            'product_name' => 'required',
        ]);

        $productName = new ProductName;
        $productName ->name_id =  'Nam' .Str::random(4); // Generate a random string with 4 characters
        $productName->product_name = $request->input('product_name');
                $productName->save();


        return response()->json($productName, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $productName = ProductName::findOrFail($id);
        return response()->json($productName, 200);
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
            'product_name' => 'required',
        ]);

        $productName = ProductName::findOrFail($id);
        $productName->update($validatedData);
        return response()->json([
            'message' => 'Product Name Updated Successfully',
            'product_name' => $productName
            ], 200);
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $productName = ProductName::findOrFail($id);
        $productName->delete();
        return response()->json([
            'message' => 'Product Name Deleted Successfully',
            
        ], 204);
    }
}