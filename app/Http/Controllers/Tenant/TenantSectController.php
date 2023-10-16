<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Tenant;
use App\Models\Apartment;
use App\Models\Complain;

class TenantSectController extends Controller
{
    public function __construct() {
        // $this->middleware('role:tenant')->only(['staffMethod']);
        $this->middleware('role:tenant');
    }

    public function index(Request $request)
    {
        return view('tenant.index')
            ->with('users', User::orderBy('created_at', 'desc')->get())
            ->with('tenants', Tenant::orderBy('created_at', 'desc')->get())
            ->with('apartments', Apartment::orderBy('created_at', 'desc')->get())
            ->with('complains', Complain::orderBy('created_at', 'desc')->get())
            ->with('settled_complains', Complain::where('status', 'settled')->orderBy('created_at', 'desc')->get())
            ->with('available_apartments', Apartment::where('tenant_id', null)->orderBy('created_at', 'desc')->get());


        // return view('tenant.index');
    }



}
