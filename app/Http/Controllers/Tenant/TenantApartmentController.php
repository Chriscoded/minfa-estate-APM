<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;

class TenantApartmentController extends Controller
{
    public function __construct() {
        // $this->middleware('role:tenant')->only(['staffMethod']);
        $this->middleware('role:tenant');
    }
    //

    public function available_apartments()
    {
        return View('tenant.apartments.index')
            ->with('apartments', Apartment::where('tenant_id', null)->orderBy('created_at', 'desc')->get())
            ->with('tenant')
            ->with('building');
    }

}
