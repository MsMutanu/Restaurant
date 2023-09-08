<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\reservation;
use App\Models\RestaurantTables;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ReservationController extends Controller
{
    public function sentReservation(Request $request)

    
{
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'time' => 'required',
        'date' => 'required',
        'description' => 'required',
        'table_id' => 'required|exists:restauranttables,id', 
    ]);

    // Create a new reservation
    $reservation = new Reservation();
    $reservation->name = $request->name;
    $reservation->email = $request->email;
    $reservation->phone = $request->phone;
    $reservation->time = $request->time;
    $reservation->date = $request->date;
    $reservation->description = $request->description;
    $reservation->delivered = false;

    // Assign the selected table to the reservation
    $reservation->table_id = $request->table_id;

    $reservation->save();

    Toastr::success('Reservation Submitted Successfully', 'success', ["positionClass" => "toast-top-right"]);
    return redirect()->back();
}
}