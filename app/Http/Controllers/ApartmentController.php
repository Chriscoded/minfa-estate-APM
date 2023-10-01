<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Building;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ApartmentController extends Controller
{
    public function index()
    {
        return View('admin.apartments.index')
            ->with('apartments', Apartment::orderBy('created_at', 'desc')->get())
            ->with('tenants', Tenant::orderBy('created_at', 'desc')->get())
            ->with('building');
    }

    public function create()
    {
        return view('admin.apartments.create')
            ->with('buildings', Building::orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
    {
        // logger($request);
        // return back()->with(['type' => 'success','title' => 'Success','message' => 'apartment Registered Successfully'], 200);
        $validator = Validator::make($request->all(), [
            'apartment_no' => 'required',
            'apartment_type' => 'required',
            'building' => 'required',
            'floor' => 'required',
            'rent' => 'required',
        ]);

        if ($validator->fails()) {
            // logger("failed validation");

            return redirect('new-apartment/')
                ->withErrors($validator)
                ->withInput();
        } else {
            // logger("passed validation");
            // if (Auth::user()->role == 'dev' || Auth::user()->role == 'admin') {
            if (Auth::user()->hasAnyRole(['admin', 'dev'])) {
                // logger("User role is dev or admin");
                $apartment = new Apartment();
                $apartment->apartment_no = $request->get('apartment_no');
                $apartment->apartment_type = $request->get('apartment_type');
                $apartment->building_id = $request->get('building');
                $apartment->floor = $request->get('floor');
                $apartment->rent = $request->get('rent');
                $apartment->save();

                // logger("saved" . $apartment);
                // flash()->success('Apartment Registered Successfully');
                return back()->with(['type' => 'success','title' => 'Success','message' => 'Apartment Registered Successfully'], 200);
            } else {
                // flash()->error('Add apartment fail!, Duplicate email or Invalid credentials');
                return back()->with(['type' => 'error','title' => 'Error','message' => 'Add apartment fail!, Duplicate email or Invalid credentials'], 422);
            }
        }
    }

    public function show($id)
    {
        $apartment = Apartment::where('id', $id)->first();
        if ($apartment) {
            return view('admin.apartments.read')->with('apartments', Apartment::where('id', $apartment->id)->orderBy('created_at', 'desc'));
        } else {
            return view('admin.apartments.read');
        }
    }

    public function edit($id)
    {
        $apartment = Apartment::find($id);
        $buildings = Building::orderBy('created_at', 'desc')->get();
        return view('admin.apartments.edit', compact('apartment','buildings'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'apartment_no' => 'required',
            'apartment_type' => 'required',
            'building' => 'required',
            'floor' => 'required',
            'rent' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('new-apartment/')
                ->withErrors($validator)
                ->withInput();
        } else {
            if (Auth::user()->hasRole('dev') || Auth::user()->hasRole('admin')) {
                $apartment = Apartment::findOrFail($id);
                $apartment->apartment_no = $request->get('apartment_no');
                $apartment->apartment_type = $request->get('apartment_type');
                $apartment->building_id = $request->get('building');
                $apartment->floor = $request->get('floor');
                $apartment->rent = $request->get('rent');
                $apartment->save();
                // back()->with(['error' => 'User Does Not Exist!'], 422);
                // flash()->success('Apartment Registered Successfully');
                return back()->with(['type' => 'success','title' => 'Success','message' =>  'Apartment Updated Successfully'], 200);
            } else {
                // flash()->error('Add apartment fail!, Duplicate email or Invalid credentials');

                return back()->with(['type' => 'error','title' => 'Error','message' =>  'Add apartment fail!, Duplicate email or Invalid credentials'], 422);
            }
        }
    }

    public function destroy($id)
    {
        $apartment = Apartment::where('id', $id)->first();
        $apartment->delete();
        // flash()->success('Apartment Deleted Successfully');
        return back()->with(['success' => 'Apartment Deleted Successfully'], 200);
    }
}
