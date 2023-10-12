<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('role:admin');
    }

    public function login_form()
    {
        return view('auth.login');
    }

    public function index(Request $request)
    {
        // $user = $request->user()->role;

        // dd(Auth::user());
        $user = Auth::user()->hasRole('admin');
        switch ($user) {
            case 'admin':
                return view('admin.index')
                    ->with('users', User::orderBy('created_at', 'desc')->get())
                    ->with('vehicles', Vehicle::orderBy('created_at', 'desc')->get())
                    ->with('tenants', Tenant::orderBy('created_at', 'desc')->get())
                    ->with('apartments', Apartment::orderBy('created_at', 'desc')->get())
                    ->with('buildings', Building::orderBy('created_at', 'desc')->get());
                break;
            default:
                // flash()->error('User Does Not Exist!');

                // return back();


                // // Session::flash('error', "'User Does Not Exist!");
                // Session::flash('type', "error");
                // Session::flash("title", "Account Number Error");
                return back()->with(['error' => 'User Does Not Exist!'], 422);
                break;
        }
    }
}
