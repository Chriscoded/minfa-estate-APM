<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            // return redirect()->action('${App\Http\Controllers\HomeController@index}', ['parameterKey' => 'value']);
            return redirect('/admin-dash');
            // return '/admin-dash';
        } elseif (auth()->user()->hasRole('tenant')) {
            return redirect('/tenant-dash');
        }
        else{
            return view('home');
        }

    }
}
