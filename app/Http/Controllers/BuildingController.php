<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class BuildingController extends Controller
{
    public function index()
    {
        return View('admin.buildings.index')
            ->with('buildings', Building::orderBy('created_at', 'desc')->get());
    }

    public function create()
    {
        return view('admin.buildings.create');
    }

    public function store(Request $request)
    {
        // logger($request);
        // return back()->with(['type' => 'success','title' => 'Success','message' => 'apartment Registered Successfully'], 200);
        $validator = Validator::make($request->all(), [
            'building_name' => 'required|unique:buildings',
            'building_address' => 'required',
        ]);

        if ($validator->fails()) {
            // logger("failed validation");

            return redirect('new-building/')
                ->withErrors($validator)
                ->withInput();
        } else {
            // logger("passed validation");
            // if (Auth::user()->role == 'dev' || Auth::user()->role == 'admin') {
            if (Auth::user()->hasAnyRole(['admin', 'dev'])) {
                // logger("User role is dev or admin");
                $building = new Building();
                $building->building_name = $request->get('building_name');
                $building->building_address = $request->get('building_address');

                $building->save();

                // logger("saved" . $building);
                // flash()->success('Building Registered Successfully');
                return back()->with(['type' => 'success','title' => 'Success','message' => 'Building Registered Successfully'], 200);
            } else {
                // flash()->error('Add building fail!, Duplicate email or Invalid credentials');
                return back()->with(['type' => 'error','title' => 'Error','message' => 'Add building fail!, Duplicate email or Invalid credentials'], 422);
            }
        }
    }

    public function show($id)
    {
        $building = building::where('id', $id)->first();
        if ($building) {
            return view('admin.buildings.read')->with('building', Building::where('id', $building->id)->orderBy('created_at', 'desc'));
        } else {
            return view('admin.buildings.read');
        }
    }

    public function edit($id)
    {
        $building = Building::find($id);
        // dd($building->building_name);
        return view('admin.buildings.edit', compact('building'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'building_name' => 'unique:buildings,building_name,' . $id,
            'building_address' => 'required',
        ]);
        // ,column,except,id
        if ($validator->fails()) {
            return redirect('new-building/')
                ->withErrors($validator)
                ->withInput();
        } else {

            if (Auth::user()->hasRole('dev') || Auth::user()->hasRole('admin')) {
                $building = Building::findOrFail($id);
                $building->building_name = $request->get('building_name');
                $building->building_address = $request->get('building_address');
                $building->save();
                // back()->with(['error' => 'User Does Not Exist!'], 422);
                // flash()->success('Apartment Registered Successfully');
                return back()->with(['type' => 'success','title' => 'Success','message' =>  'Building Updated Successfully'], 200);
            } else {
                dd("not Admin");
                // flash()->error('Add apartment fail!, Duplicate email or Invalid credentials');

                return back()->with(['type' => 'error','title' => 'Error','message' =>  'Add building fail!, Duplicate email or Invalid credentials'], 422);
            }
        }
    }

    public function destroy($id)
    {
        $building = Building::where('id', $id)->first();
        $building->delete();
        // flash()->success('Apartment Deleted Successfully');
        return back()->with(['success' => 'Building Deleted Successfully'], 200);
    }

}
