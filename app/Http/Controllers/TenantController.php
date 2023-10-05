<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Apartment;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::orderBy('created_at', 'desc')->get();
        $vehicles = Vehicle::orderBy('created_at', 'desc')->get();
        $apartments =  Apartment::orderBy('created_at', 'desc')->get();

        return View('admin.tenants.index', compact('tenants', 'vehicles', 'apartments'));
    }

    public function create()
    {
        $apartments = Apartment::where('tenant_id', null)->get();
        return view('admin.tenants.create', compact('apartments'));
    }

    public function store(Request $request)
    {
        // logger($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'apartment_no' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('new-apartment/')
                ->withErrors($validator)
                ->withInput();
        } else {
            if (Auth::user()->hasRole('dev') || Auth::user()->hasRole('admin')) {
                $tenant = new Tenant();
                $tenant->name = $request->get('name');
                $tenant->middlename = $request->get('middlename');
                $tenant->lastname = $request->get('lastname');
                $tenant->apartment_no = $request->get('apartment_no');
                $tenant->email = $request->get('email');
                $tenant->phone = $request->get('phone');
                $tenant->save();

                DB::update("update apartments set tenant_id = '$tenant->id' where apartment_no = ?", [$tenant->apartment_no]);

                // flash()->success('Tenant Registered Successfully');
                // return back();
                return back()->with(['type' => 'success','title' => 'Success','message' => 'Tenant Registered Successfully'], 200);
            } else {
                // flash()->error('Add Tenant fail!, Duplicate email or Invalid credentials');
                // return back();

                return back()->with(['type' => 'error','title' => 'Error','message' => 'Add Tenant fail!, Duplicate email or Invalid credentials'], 422);
            }
        }
    }

    public function show($id)
    {
        $tenant = Tenant::where('id', $id)->first();
        if ($tenant) {
            return view('admin.tenants.read')->with('users', Tenant::where('id', $tenant->id)->orderBy('created_at', 'desc'));
        } else {
            return view('admin.tenants.read');
        }
    }

    public function edit($id)
    {
        $tenant = Tenant::find($id);
        $apartments =  Apartment::where('tenant_id', null)->orderBy('created_at', 'desc')->get();
        // $users = User:
        return view('admin.tenants.edit', compact('tenant', 'apartments'));
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'apartment_no' => 'required',
            'email' => 'required',
            'phone' => 'required',
        );
        // if($request->apartment_no == 'null'){
        //     logger('null');
        // }
        logger($request);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('edit-tenant/' . $id)
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            $user = Tenant::findOrFail($id);
            if (Auth::user()->hasRole('dev') || Auth::user()->hasRole('admin')) {

                // if the partment no is set as to none them set the tenant_id to null in apartment table
                if($request->apartment_no == 'null'){
                    // logger('null');
                    DB::update("update apartments set tenant_id = null where apartment_no = ?", [$user->apartment_no]);
                    //set the apartment_no to null in tenant table
                    $user->apartment_no = '';
                }
                else{
                    $user->apartment_no = $request->get('apartment_no');
                    // in a situation where the apartment is null we have to update the apartment as well with the tenant id
                    $apt = Apartment::where('tenant_id', $user->id)->get();
                    if(count($apt) == 0){
                        DB::update("update apartments set tenant_id = '$user->id' where apartment_no = ?", [$user->apartment_no]);
                    }
                }

                $user->name = $request->get('name');
                $user->middlename = $request->get('middlename');
                $user->lastname = $request->get('lastname');
                $user->email = $request->get('email');
                $user->phone = $request->get('phone');
                $user->save();
                // flash()->success('Update Successful');
                // return back();
                return back()->with(['type' => 'success','title' => 'Success','message' => 'Update Successful'], 200);

            }
        }
    }

    public function destroy($id)
    {
        $tenant = Tenant::where('id', $id)->first();
        $tenant->delete();
        // flash()->success('Tenant Deleted Successfully');
        // return back();
        return back()->with(['type' => 'success','title' => 'Success','message' => 'Tenant Deleted Successfully'], 200);
    }
}
