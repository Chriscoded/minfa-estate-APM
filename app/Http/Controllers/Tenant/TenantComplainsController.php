<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Complain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class TenantComplainsController extends Controller
{
    public function __construct() {
        // $this->middleware('role:tenant')->only(['staffMethod']);
        $this->middleware('role:tenant');
    }
    //
    public function index(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $tenant_id = $user->tenant_id;
        $complains = Complain::where('tenant_id', $tenant_id)->orderBy('id', 'desc')->get();
        // dd($rent);
        return view('tenant.complains.index', compact('complains'));
    }

    public function new_complain()
    {

        return view('tenant.complains.create');
    }

    public function store(Request $request)
    {
        // logger($request);
        // return back()->with(['type' => 'success','title' => 'Success','message' => 'apartment Registered Successfully'], 200);
        $validator = Validator::make($request->all(), [
            'complain' => 'required',
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        // dd($user);

        if ($validator->fails()) {
            // logger("failed validation");

            return redirect('my-new-complain/')
                ->withErrors($validator)
                ->withInput();
        } else {
            // logger("passed validation");
            // if (Auth::user()->role == 'dev' || Auth::user()->role == 'admin') {
            if (Auth::user()->hasAnyRole('tenant')) {
                // logger("User role is dev or admin");
                // dd($user);
                $rent = new Complain();
                $rent->complain = $request->get('complain');
                $rent->tenant_id = $user->tenant_id;
                $rent->status = 'unsettled';

                if ($request->hasFile('image')) {

                    $file = $request->file('image');
                    $fileName = "Receipt" . time() . '.' . $file->getClientOriginalExtension();
                    // $fileName = time() . '.' . $request->image->extension();
                    $file->storeAs('public/images/complains', $fileName);

                    $rent->image = $fileName;
                }

                $rent->save();

                // logger("saved" . $apartment);
                // flash()->success('Apartment Registered Successfully');
                return back()->with(['type' => 'success','title' => 'Success','message' => 'Complain Submitted Successfully'], 200);
            } else {
                // flash()->error('Add apartment fail!, Duplicate email or Invalid credentials');
                return back()->with(['type' => 'error','title' => 'Error','message' => 'Complain failed to submit!'], 422);
            }
        }
    }

}
