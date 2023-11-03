<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function users()
    {
        return View('admin.payments.index')
            ->with('payments', Payment::orderBy('created_at', 'desc')->get());
    }

    public function create()
    {
        return view('admin.payments.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'company' => 'required',
            'phone' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('new-tenant/')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            if (Auth::user()->role == 'dev' || Auth::user()->role == 'admin') {
                $user = new Payment();
                $user->name = $request->get('name');
                $user->lastname = $request->get('lastname');
                $user->email = $request->get('email');
                $user->company = $request->get('company');
                $user->phone = $request->get('phone');
                $user->role = 'seller';
                $user->password = bcrypt(str::random(10));
                $user->save();
                flash()->success('Payment Registered Successfully');
                return back();
            } else {
                flash()->error('Add Payment fail!, Duplicate email or Invalid credentials');
                return back();
            }
        }
    }

    public function show($id)
    {
        $payment = Payment::where('id', $id)->first();
        if ($payment) {
            return view('admin.payments.read')->with('payments', Payment::where('id', $payment->id)->orderBy('created_at', 'desc'));
        } else {
            return view('admin.payments.read');
        }
    }

    public function edit($id)
    {
        $payments = Payment::find($id);
        return view('admin.payments.edit')->with('payments', Payment::where('id', $id)->get());
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'company' => 'required',
            'password' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('edit-tenant/' . $id)
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            $user = Payment::findOrFail($id);
            if (Auth::user()->role == 'dev' || Auth::user()->role == 'admin') {
                $user->name = $request->get('name');
                $user->lastname = $request->get('lastname');
                $user->email = $request->get('email');
                $user->phone = $request->get('phone');
                $user->company = $request->get('company');
                $user->role = 'seller';
                $password = $request->get('password');
                $confirm_password = $request->get('password_confirmation');
                if ($password != $confirm_password) {
                    flash()->error('Passwords Dont Match! Check passwords and try again');
                    return back();
                } else {
                    $user->password = bcrypt($request->get('password'));
                }
                $user->save();
                flash()->success('Update Successful');
                return back();
            }
        }
    }

    public function destroy($id)
    {
        $payment = Payment::where('id', $id)->first();
        $payment->delete();
        return back()->with(['success' => 'Payment Deleted Successfully'], 200);
    }

    public function destroy_rent($id)
    {
        $payment = Rent::where('id', $id)->first();
        $filePath = 'public/images/payment_proof/' . $payment->proof; // $filename is the name of the file you saved

        // logger($filePath);
        // Check if the file exists
        if (Storage::exists($filePath)) {
            // Delete the file
            Storage::delete($filePath);
        }
        $payment->delete();
        return back()->with(['success' => 'Rent Deleted Successfully'], 200);
    }

    public function all_paid_rents(Request $request)
    {
        $rents = Rent::with('tenant')->with('apartment')->get();
        // dd($rents);
        return view('admin.rent.index', compact('rents'));
    }

    public function accept_rent(Request $request){
        if ($request->ajax()) {
            $rent_id = $request->input('id');

            $rent= Rent::where('id', $rent_id)->latest('created_at')->first();

            $rent->status = "confirmed";
            $rent->save();
            $res = [
                'message'=> "rent confirmed"
            ];
            return json_encode($res);
        }
    }

}
