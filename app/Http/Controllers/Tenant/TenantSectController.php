<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantSectController extends Controller
{
    public function __construct() {
        // $this->middleware('role:tenant')->only(['staffMethod']);
        $this->middleware('role:tenant');
    }

    public function index(Request $request)
    {
        return view('tenant.index');
    }



}
