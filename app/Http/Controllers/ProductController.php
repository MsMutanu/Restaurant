<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        
        $products = Product::all();
        
        if (request()->wantsJson()) {
            return response()->json($products);
        }
        return view('admin.products.index', ['products' => $products]);
    }

    
    public function create()
{
    $productNames = ProductName::all();
    $productCategories = ProductCategory::all();
    // dd($productNames);
    // dd($productCategories);

    return view('admin.products.create', compact('productNames', 'productCategories'));
}


    public function store(Request $request)
    {
        $request->validate([
            'name_id' => 'required|exists:ProductNames,name_id',
            'category_id' => 'required|exists:ProductCategory,category_id',
            'product_price' => 'required|numeric',
        'product_details' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('product_images', 'public');
        $product = new Product();
        $product->product_id = 'Prod'.Str::random(4);
        $product->name_id = $request->input('name_id');
        $product->category_id = $request->input('category_id');
        $product->product_price = $request->input('product_price');
        $product->product_details = $request->input('product_details');
        $product->image = $imagePath;
        $product->save();
        return redirect()->route('admin.products.create')->with('success', 'Product created successfully');


        }

   
    }

    public function edit($product_id)
    {
        
        $product = Product::find($product_id);
        return view('admin.products.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $validatedData= $request->validate([
            'name_id' => 'required|exists:ProductNames,name_id',
            'category_id' => 'required|exists:ProductCategory,category_id',
            'product_price' => 'required|numeric',
        'product_details' => 'required|string',
            
        
        ]);
        $product->update($validatedData);

        if (request()->wantsJson()) {
            return response()->json($product);
        }
            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        
    }

    public function destroy($product_id)

    {
        $product = Product::find($product_id);

        if ($product){
            $product -> delete();
        
        
            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
        }else {
            return back()->with('error', 'Failed to delete product.');
        }
    }
    
}
