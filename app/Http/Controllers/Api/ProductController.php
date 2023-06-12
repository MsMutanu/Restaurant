<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductName;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
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
        'product_id' => 'required|string|max:255',
        'name_id' => 'required|exists:ProductNames,name_id',
        'category_id' => 'required|exists:ProductCategory,category_id',
        'product_price' => 'required|numeric',
        'product_details' => 'required|string',
    ];

    // Validate the request data
    $validator = Validator::make($request->all(), $rules);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    // Validation passed, create the product
    $product = new Product;
    $product->product_id = $request->input('product_id');
    $product->name_id = $request->input('name_id');
    $product->category_id = $request->input('category_id');
    $product->product_price = $request->input('product_price');
    $product->product_details = $request->input('product_details');

    // Check if the name_id corresponds to an existing name
    $existingName = ProductName::find($product->name_id);
    if (!$existingName) {
        return response()->json(['error' => 'Invalid name_id'], 400);
    }

    // Check if the category_id corresponds to an existing category
    $existingCategory = ProductCategory::find($product->category_id);
    if (!$existingCategory) {
        return response()->json(['error' => 'Invalid category_id'], 400);
    }

    $product->save();

    return response()->json($product, 201);
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
            'name_id' => 'required',
            'category_id' => 'required',
            'product_price' => 'required',
            'product_details' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}
