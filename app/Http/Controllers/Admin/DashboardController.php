<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Slider;
use App\Models\reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserOrder;
use Illuminate\Foundation\Auth\User;

class DashboardController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function index()
    {
        $user = User::count();
        $item = Item::count();
        $reservation = reservation::count();
        $userOrder = UserOrder::count();
        $reservationpending = Reservation::where('delivered', false)->count();
        $reservationconfirmed = Reservation::where('delivered', true)->count();
        $pendingOrderCount = UserOrder::where('status', false)->count();
        $confirmedOrderCount=UserOrder::where('status', true)->count();

        return view('admin.dashboard', compact( 'user','item',  'reservation', 'reservationpending', 'reservationconfirmed','userOrder', 'pendingOrderCount','confirmedOrderCount'));

    }
}
