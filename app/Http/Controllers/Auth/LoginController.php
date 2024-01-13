<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1])) {
            $user = auth()->user();

            if ($user->is_admin == 1) {
                Toastr::success('Admin Dashboard.', 'Logged in Success!', ["positionClass" => "toast-top-right"]);
                return redirect()->route('admin.dashboard');
            } elseif ($user->is_waiter == 1) {
                Toastr::success('Waiter Dashboard.', 'Logged in Success!', ["positionClass" => "toast-top-right"]);
                return redirect()->route('waiter.index');
            } elseif ($user->is_kitchen_staff == 1) {
                Toastr::success('Kitchen Staff Dashboard.', 'Logged in Success!', ["positionClass" => "toast-top-right"]);
                return redirect()->route('kitchen.index');
            } else {
                return redirect()->route('frontend.index');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid email or password!');
        }
    }


    public function userslogin(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
            if (auth()->user()->is_admin == 1) {
                $this->guard()->logout();
                $request->session()->invalidate();
                Toastr::warning('Wrong! You are an admin, Redirect to back!', 'Invalid actions!', ["positionClass" => "toast-top-right"]);
                return redirect()->route('admin.login');
            } else if (auth()->user()->is_waiter == 1) {
                Toastr::success('Welcome ' . Auth::user()->name, 'Logged in!', ["positionClass" => "toast-top-right"]);
                return redirect()->route('waiter.index');
            } else if (auth()->user()->is_kitchen_staff == 1) {
                Toastr::success('Welcome ' . Auth::user()->name, 'Logged in!', ["positionClass" => "toast-top-right"]);
                return redirect()->route('kitchen.index');
            } else {
                return redirect()->route('fontend.index');

            }
        }else{
            //Toastr::error('Invalid email or password', 'Wrong', ["positionClass" => "toast-top-right"]);
            //return redirect()->back();
           return redirect()->back()->with('error','Invalid email or password !');
        }

    }

      //users login here
      public function userLogin()
     {
        return view('auth.userlogin');
      }

          //admin login here
      public function adminLogin()
     {
        return view('auth.adminlogin');
      }





}
