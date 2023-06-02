<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Waiter;
use Illuminate\Support\Str;

class WaiterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $waiters = Waiter::all();
        return response()->json($waiters, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'contact' => 'required|integer',
            'waiter_no' => 'required|integer',
        ]);

        $waiter = new Waiter;
        $waiter->wait_id = 'WAIT'. Str::random(4);
        $waiter->name = $request->input('name');
        $waiter->contact = $request->input('contact');
        $waiter->waiter_no = $request->input('waiter_no');
        $waiter->save();
        
        return response()->json($waiter, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $waiter = Waiter::findOrFail($id);
        return response()->json($waiter, 200);
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
            'name' => 'required',
            'contact' => 'required|integer',
            'waiter_no' => 'required|integer',
        ]);

        $waiter = Waiter::findOrFail($id);
        $waiter->update($validatedData);
        return response()->json($waiter, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $waiter = Waiter::findOrFail($id);
        $waiter->delete();
        return response()->json(null, 204);
    }
}
