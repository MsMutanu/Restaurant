<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableStoreRequest;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
      $tables = RestaurantTable::all();
      return view('admin.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
      return view('admin.tables.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(TableStoreRequest $request)
    {
      RestaurantTable::create([
        'name' => $request->name,
        'guest_number' => $request->guest_number,
        'status' => $request->status,
        'location' => $request->location,
      ]);

      return to_route('admin.tables.index')->with('success', 'Table created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * 
     */
    public function edit(RestaurantTable $table)
    {
      return view('admin.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     */
    public function update(TableStoreRequest $request, RestaurantTable $table)
    {
      $table->update($request->validated());

      return to_route('admin.tables.index')->with('success', 'Table updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * 
     */
    public function destroy(RestaurantTable $table)
    {
      $table->reservations()->delete();
      $table->delete();

      return to_route('admin.tables.index')->with('danger', 'Table deleted successfully');
    }
}
