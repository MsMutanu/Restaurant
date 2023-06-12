<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8000/api/product');
        $products = $response->json();

        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_id' => 'required|exists:ProductNames,name_id',
            'category_id' => 'required|exists:ProductCategory,category_id',
            'product_price' => 'required|numeric',
        'product_details' => 'required|string',
            
        ]);
        $response = Http::post('http://localhost:8000/api/product', $request->all());

        if ($response->successful()) {
            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        } else {
            return back()->withInput()->with('error', 'Failed to create product.');
        }
    }

    public function edit($product_id)
    {
        
        $response = Http::get("http://localhost:8000/api/product/$product_id");
        $product = $response->json();

        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, $product_id)
    {
        $request->validate([
            'name_id' => 'required|exists:ProductNames,name_id',
            'category_id' => 'required|exists:ProductCategory,category_id',
            'product_price' => 'required|numeric',
        'product_details' => 'required|string',
            
        ]);
        $response = Http::put("http://localhost:8000/api/product/$product_id", $request->all());

        if ($response->successful()) {
            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } else {
            return back()->withInput()->with('error', 'Failed to update product.');
        }
    }

    public function destroy($product_id)
    {
        $response = Http::delete("http://localhost:8000/api/product/$product_id");

        if ($response->successful()) {
            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } else {
            return back()->with('error', 'Failed to delete product.');
        }
    }
}
