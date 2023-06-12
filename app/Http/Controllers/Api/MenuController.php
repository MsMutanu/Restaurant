<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $menus = Menu::all();
        return response()->json($menus, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'product_id' => 'required|exists:Product,product_id',
            'product_details' => 'required',
            
        ];
     // Validate the request data
     $validator = Validator::make($request->all(), $rules);

     // Check if validation fails
     if ($validator->fails()) {
         return response()->json(['errors' => $validator->errors()], 400);
     }   

        $menu = new Menu;
        $menu->menu_id = 'Menu' .Str::random(4); // Generate a random string with 4 characters
        $menu->product_id = $request->input('product_id');
        $menu->product_details = $request->input('product_details');

 // Check if the product_id corresponds to an existing product
 $existingProduct = Product::find($menu->product_id);
 if (!$existingProduct) {
     return response()->json(['error' => 'Invalid product_id'], 400);
 }

        $menu->save();
        return response()->json($menu, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json($menu, 200);
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
            'product_id' => 'required',
            'product_details' => 'required',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($validatedData);
        return response()->json([
            'message'=> 'Menu item updated succesfuly',
            'menu' => $menu

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
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return response()->json([
            'message'=> 'Menu item deleted succesfuly'
        ], 204);
    }
}
