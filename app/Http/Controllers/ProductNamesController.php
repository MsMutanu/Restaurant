<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductNamesController extends Controller
{
    /**
     * Display a listing of the product names.
     *
     * 
     */
    public function index()
    {
        $response = Http::timeout(60)->get('http://localhost:8000/api/productname/');

        $productNames = $response->json();

        return view('productnames.index', compact('productNames'));
    }

    /**
     * Show the form for creating a new product name.
     *
     * 
     */
    public function create()
    {
        return view('productnames.create');
    }

    /**
     * Store a newly created product name in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(Request $request)
    {
        $response = Http::post('http://localhost:8000/api/productname', [
            'product_name' => $request->input('product_name'),
        ]);

        if ($response->successful()) {
            return redirect()->route('productnames.index')->with('success', 'Product name added successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to add product name.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     */
    public function show($name_id)
    {
        $response = Http::timeout(60)->get('http://localhost:8000/api/productname/' . $name_id);
        $productName = $response->json();

        return view('productnames.show', ['category' => $productName]);
    }

    /**
     * Show the form for editing the specified product name.
     *
     * @param  int  $name_id
     * 
     */
    public function edit($name_id)
    {
        $response = Http::get('http://localhost:8000/api/productname' . $name_id);

        $productName = $response->json();

        return view('productnames.edit', compact('productName'));
    }

    /**
     * Update the specified product name in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     */
    public function update(Request $request, $name_id)
    {
        $response = Http::put('http://localhost:8000/api/productname' . $name_id, [
            'product_name' => $request->input('product_name'),
        ]);

        if ($response->successful()) {
            return redirect()->route('productnames.index')->with('success', 'Product name updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update product name.');
        }
    }

    /**
     * Remove the specified product name from storage.
     *
     * @param  int  $name_id
     * 
     */
    public function destroy($name_id)
    {
        $response = Http::timeout(60)->delete('http://localhost:8000/api/productname' . $name_id);

        if ($response->successful()) {
            return redirect()->route('productnames.index')->with('success', 'Product name deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete product name.');
        }
    }
}

