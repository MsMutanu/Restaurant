<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Http;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        // Retrieve all product categories
        $categories = ProductCategory::all();

        // Check if the request is an API request
        if (request()->wantsJson()) {
            return response()->json($categories);
        }

        // Render the view for web requests
        return view('admin.productcategory.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.productcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'category' => 'required|unique:ProductCategory|max:255',
        ]);

        // Create a new product category
        $category = ProductCategory::create($validatedData);

        // Check if the request is an API request
        if (request()->wantsJson()) {
            return response()->json($category, 201);
        }

        // Redirect 
        return redirect()->route('admin.productcategory.index')->with('success', 'Product Category added successfully');
    }

    public function edit($category_id)
    {
        $category = ProductCategory::find($category_id);
        return view('admin.productcategory.edit', ['category' => $category]);
    }

    public function show($category_id)
{
    $category = ProductCategory::find($category_id);
    return view('admin.productcategory.show', compact('category'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $category
     * 
     */
    public function update(Request $request, ProductCategory $category,)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'category' => 'required|unique:ProductCategory|max:255',
        ]);

        // Update the product category
        $category->update($validatedData);

        // Check if the request is an API request
        if (request()->wantsJson()) {
            return response()->json($category);
        }

        // Redirect or return a response for web requests
        return redirect()->route('admin.productcategory.index')->with('success', 'Product Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $category
     * 
     */
    
    public function destroy($category_id)
{
    // Find the ProductCategory instance with the given ID
    $category = ProductCategory::find($category_id);

    if ($category) {
        // Delete the category
        $category->delete();

        // Redirect to a specific route or perform any additional logic
        // after successful deletion
        return redirect()->route('admin.productcategory.index')
            ->with('success', 'Category deleted successfully');
    } else {
        // Category not found, handle the error accordingly
        return redirect()->route('admin.productcategory.index')
            ->with('error', 'Category not found');
    }
}

    
    
}
