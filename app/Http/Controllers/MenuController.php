<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\OrderItem;

class MenuController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        $products = Product::all();

        return view('client.menu.index', ['categories'=> $categories, 'products'=> $products]);
    }

    public function getProductsByCategory($category)
    {
        //$categoryId = $request->input('category');
        $products = Product::where('category_id', $category)->get();

        return response()->json($products);
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $orderItem = OrderItem::create([
            'product_id' => $product->product_id,
            
        ]);

        return response()->json($orderItem);
    }

    public function getOrderItems()
    {
        $orderItems = OrderItem::all();

        return response()->json($orderItems);
    }

    public function placeOrder()
    {
        // Logic to place the order with the cart items

        // Clear the cart items
        OrderItem::truncate();

        return response()->json(['message' => 'Order placed successfully']);
    }
}
