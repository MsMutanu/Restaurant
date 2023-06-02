<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = ProductCategory::all();
        return response()->json($categories, 200);
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
            'category' => 'required',
        ]);

        $category = new ProductCategory;
        $category->category_id = 'Cat' .Str::random(4); // Generate a random string with 4 characters
        $category->category = $request->input('category');
        $category->save();
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $category = ProductCategory::findOrFail($id);
        return response()->json($category, 200);
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
            'category' => 'required',
        ]);

        $category = ProductCategory::findOrFail($id);
        $category->update($validatedData);
        return response()->json([
        'message' => 'Category updated successfuly',
        'category' => $category
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
        $category = ProductCategory::findOrFail($id);
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfuly'
        ], 204);
    }
}
