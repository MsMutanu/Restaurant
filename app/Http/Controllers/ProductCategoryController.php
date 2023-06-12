<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        //$response = Http::get('http://localhost:8000/api/productcategory');
        //$categories = $response->json();

        //return view('productcategory.index', ['categories' => $categories]);
        echo 'Hello';
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        return view('productcategy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|unique:ProductCategory|max:255',
        ]);

        $response = Http::post('http://localhost:8000/api/productcategory', [
            'category' => $request->input('category'),
        ]);
        if ($response->successful()) {
            return redirect()->route('producategort.index')->with('success', 'Product Category added successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to add product Category.');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $category_id
     *
     */
    public function show($category_id)
    {
        $response = Http::get('http://localhost:8000/api/productcategory/' . $category_id);
        $category = $response->json();

        return view('productcategory.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $category_id
     * 
     */
    public function edit($category_id)
    {
        $response = Http::get('http://localhost:8000/api/productcategory/' . $category_id);
        $category = $response->json();

        return view('productcategory.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $category_id
     * 
     */
    public function update(Request $request, $category_id)
    {
        $request->validate([
            'category' => 'required|unique:ProductCategory|max:255',
        ]);

        $response = Http::put('http://localhost:8000/api/productcategory/' . $category_id, [
            'category' => $request->input('category'),
        ]);

        return redirect()->route('productcategory.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $category_id
     * 
     */
    public function destroy($category_id)
    {
        $response = Http::delete('http://localhost:8000/api/productcategory/' . $category_id);

        return redirect()->route('productcategories.index')->with('success', 'Category deleted successfully.');
    }
}
