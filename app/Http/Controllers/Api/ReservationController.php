<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Table;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $reservations = Reservation::all();
        return response()->json($reservations, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
   

public function store(Request $request)
{
    // Define the validation rules
    $rules = [
        'cust_id' => 'required|exists:Customer,cust_id',
        'resttable_no' => 'required|integer|exists:RestaurantTable,resttable_no',
        'no_of_seats' => 'required|integer',
        'date' => 'required|date',
        'time' => 'required',
    ];

    // Validate the request data
    $validator = Validator::make($request->all(), $rules);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    // Validation passed, create the reservation
    $reservation = new Reservation;
    $reservation->reserve_id= 'RES'.str::random(4);
    $reservation->cust_id = $request->input('cust_id');
    $reservation->resttable_no = $request->input('resttable_no');
    $reservation->no_of_seats = $request->input('no_of_seats');
    $reservation->date = $request->input('date');
    $reservation->time = $request->input('time');

    // Check if the cust_id corresponds to an existing customer
    $existingCustomer = Customer::find($reservation->cust_id);
    if (!$existingCustomer) {
        return response()->json(['error' => 'Invalid cust_id'], 400);
    }
    $validatedData = $request->validate([
        'resttable_no' => 'required|integer|exists:RestaurantTable,resttable_no',
    ]);
    

    $reservation->save();

    return response()->json($reservation, 201);
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return response()->json($reservation, 200);
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
            'cust_id' => 'required',
            'resttable_no' => 'required|integer',
            'no_of_seats' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update($validatedData);
        return response()->json($reservation, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return response()->json(['message'=>'Reservation Deleted', 204]);
    }
}
