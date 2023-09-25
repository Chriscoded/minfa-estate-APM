<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class UnitController extends Controller
{
    public function index()
    {
        return View('admin.units.index')
            ->with('units', Unit::orderBy('created_at', 'desc')->get())
            ->with('tenants', Tenant::orderBy('created_at', 'desc')->get());
    }

    public function create()
    {
        return view('admin.units.create');
    }

    public function store(Request $request)
    {
        // logger($request);
        // return back()->with(['type' => 'success','title' => 'Success','message' => 'Unit Registered Successfully'], 200);
        $validator = Validator::make($request->all(), [
            'unit_no' => 'required',
            'unit_type' => 'required',
            'block' => 'required',
            'floor' => 'required',
            'rent' => 'required',
        ]);

        if ($validator->fails()) {
            // logger("failed validation");

            return redirect('new-unit/')
                ->withErrors($validator)
                ->withInput();
        } else {
            // logger("passed validation");
            // if (Auth::user()->role == 'dev' || Auth::user()->role == 'admin') {
            if (Auth::user()->hasAnyRole(['admin', 'dev'])) {
                // logger("User role is dev or admin");
                $unit = new Unit();
                $unit->unit_no = $request->get('unit_no');
                $unit->unit_type = $request->get('unit_type');
                $unit->block = $request->get('block');
                $unit->floor = $request->get('floor');
                $unit->rent = $request->get('rent');
                $unit->save();

                // logger("saved" . $unit);
                // flash()->success('Unit Registered Successfully');
                return back()->with(['type' => 'success','title' => 'Success','message' => 'Unit Registered Successfully'], 200);
            } else {
                // flash()->error('Add unit fail!, Duplicate email or Invalid credentials');
                return back()->with(['type' => 'error','title' => 'Error','message' => 'Add unit fail!, Duplicate email or Invalid credentials'], 422);
            }
        }
    }

    public function show($id)
    {
        $unit = Unit::where('id', $id)->first();
        if ($unit) {
            return view('admin.units.read')->with('units', Unit::where('id', $unit->id)->orderBy('created_at', 'desc'));
        } else {
            return view('admin.units.read');
        }
    }

    public function edit($id)
    {
        $units = Unit::find($id);
        return view('admin.units.edit')->with('units', Unit::where('id', $id)->get());
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'unit_no' => 'required',
            'unit_type' => 'required',
            'block' => 'required',
            'floor' => 'required',
            'rent' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('new-unit/')
                ->withErrors($validator)
                ->withInput();
        } else {
            if (Auth::user()->role == 'dev' || Auth::user()->role == 'admin') {
                $unit = Unit::findOrFail($id);
                $unit->unit_no = $request->get('unit_no');
                $unit->unit_type = $request->get('unit_type');
                $unit->block = $request->get('block');
                $unit->floor = $request->get('floor');
                $unit->rent = $request->get('rent');
                $unit->save();
                // back()->with(['error' => 'User Does Not Exist!'], 422);
                // flash()->success('Unit Registered Successfully');
                return back()->with(['type' => 'success','title' => 'Success','message' =>  'Unit Registered Successfully'], 200);
            } else {
                // flash()->error('Add unit fail!, Duplicate email or Invalid credentials');

                return back()->with(['type' => 'success','title' => 'Success','message' =>  'Unit Registered Successfully'], 422);
            }
        }
    }

    public function destroy($id)
    {
        $unit = Unit::where('id', $id)->first();
        $unit->delete();
        // flash()->success('Unit Deleted Successfully');
        return back()->with(['success' => 'Unit Deleted Successfully'], 200);
    }
}
