<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\reservation;
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
            'description' => 'required'
             
        ]);
         
        $reservation = new reservation();
        $reservation->name = $request->name;
        $reservation->email = $request->email;
        $reservation->phone = $request->phone;
        $reservation->time = $request->time;
        $reservation->date = $request->date;
        $reservation->description = $request->description;
        $reservation->delivered = false;
        
        $reservation->save();
        Toastr::success('Researvation Submit Successfully', 'success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
