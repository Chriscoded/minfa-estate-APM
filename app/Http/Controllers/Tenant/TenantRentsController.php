<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Rent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class TenantRentsController extends Controller
{
    public function index(Request $request)
    {
        return view('tenant.rent.index');
    }

    public function new_rent()
    {
        return view('tenant.rent.create');
    }

    public function store(Request $request)
    {
        // logger($request);
        // return back()->with(['type' => 'success','title' => 'Success','message' => 'apartment Registered Successfully'], 200);
        $validator = Validator::make($request->all(), [
            'payment_medium' => 'required',
            'proof' => 'required',
            'period' => 'required',
            'amount' => 'required'
        ]);

        $user = User::where('tenant_id', Auth::user()->id)->get();
        dd($tenant);

        if ($validator->fails()) {
            // logger("failed validation");

            return redirect('my-new-rent/')
                ->withErrors($validator)
                ->withInput();
        } else {
            // logger("passed validation");
            // if (Auth::user()->role == 'dev' || Auth::user()->role == 'admin') {
            if (Auth::user()->hasAnyRole('tenant')) {
                // logger("User role is dev or admin");
                $rent = new Rent();
                $rent->payment_medium = $request->get('payment_medium');

                if ($request->hasFile('proof')) {

                    $file = $request->file('proof');
                    $fileName = "Receipt" . time() . '.' . $file->getClientOriginalExtension();
                    // $fileName = time() . '.' . $request->image->extension();
                    $file->storeAs('public/payment_proof', $fileName);

                    $rent->proof = $fileName;
                }

                $rent->save();

                // logger("saved" . $apartment);
                // flash()->success('Apartment Registered Successfully');
                return back()->with(['type' => 'success','title' => 'Success','message' => 'Payment Submitted Successfully'], 200);
            } else {
                // flash()->error('Add apartment fail!, Duplicate email or Invalid credentials');
                return back()->with(['type' => 'error','title' => 'Error','message' => 'Payment failed to submit!'], 422);
            }
        }
    }
}

