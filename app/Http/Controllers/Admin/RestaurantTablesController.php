<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantTables;
use Illuminate\Http\Request;

class RestaurantTablesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restauranttables = RestaurantTables::all();
        return view('admin.restauranttables.index', compact('restauranttables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.restauranttables.create');
    }
    public function show($id)
{
    
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'status' => 'required|string|max:255',
        ]);

        RestaurantTables::create([
            'name' => $request->input('name'),
            'capacity' => $request->input('capacity'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('restauranttables.index')->with('success', 'Table created successfully');
    }

    public function update(Request $request, RestaurantTables $restauranttable)
    {
        // Validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'status' => 'required|string|max:255',
        ]);

        $restauranttable->update([
            'name' => $request->input('name'),
            'capacity' => $request->input('capacity'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('restauranttables.index')->with('success', 'Table updated successfully');
    }

    public function edit(RestaurantTables $restauranttable)
    {
        return view('admin.restauranttables.edit', compact('restauranttable'));
    }

    public function destroy($id)
    {
        $restauranttable = RestaurantTables::find($id);
        if (!$restauranttable) {
            // The record with the given $id was not found
            return redirect()->route('restauranttables.index')->with('danger', 'Table not found');
        }

        // The record was found, now you can safely delete it
        $restauranttable->delete();

        return redirect()->route('restauranttables.index')->with('danger', 'Table deleted successfully');
    }
}
