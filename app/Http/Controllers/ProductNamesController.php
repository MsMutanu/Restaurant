<?php

namespace App\Http\Controllers;

use App\Models\ProductName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ProductNamesController extends Controller
{
    /**
     * Display a listing of the product names.
     *
     * 
     */
    public function index()
    {
        $names = ProductName::all();
        if (request()->wantsJson()) {
            return response()->json($names);
        }
        

        return view('admin.productnames.index', ['names' => $names]);
    }

    /**
     * Show the form for creating a new product name.
     *
     * 
     */
    public function create()
    {
        return view('/admin/productnames/create');
    }

    /**
     * Store a newly created product name in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|unique:ProductNames|max:255',
        ]);
        $name = new ProductName;
        $name->name_id = 'Nam' . Str::random(4);
        $name->product_name = $request->input('product_name');
        $name->save();
        
            // Check if the request is an API request
        if ($request->wantsJson()) {
            return response()->json($name, 201);
        }
        
            return redirect()->route('productnames.index')->with('success', 'Product name created successfully');
        }
        
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     */
    public function show($name_id)
    {
        $name = ProductName::findOrFail($name_id);
        return view('productnames.show', ['name' => $name]);
    }

    /**
     * Show the form for editing the specified product name.
     *
     * @param  int  $name_id
     * 
     */
    public function edit($name_id)
    {
        $name = ProductName::findOrFail($name_id);
    return view('productnames.edit', ['name' => $name]);
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
        $name = ProductName::findOrFail($name_id);

        // Update the product name attributes with the request data
        $name->name = $request->input('name');
        
        // Save the updated product name to the database
        $name->save();
    
        return redirect()->route('productnames.index')->with('success', 'Product name updated successfully.');
    }

    /**
     * Remove the specified product name from storage.
     *
     * @param  int  $name_id
     * 
     */
    public function destroy($name_id)
{
    $name = ProductName::find($name_id);

    if ($name) {
        $name->delete();
        return redirect()->route('productnames.index')->with('success', 'Product Name deleted successfully');
    } else {
        return redirect()->route('productnames.index')->with('error', 'Name not found');
    }
}


        
    }
    


