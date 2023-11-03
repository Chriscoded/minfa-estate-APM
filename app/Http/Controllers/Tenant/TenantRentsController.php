<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Rent;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Carbon\Carbon;


class TenantRentsController extends Controller
{
    public function __construct() {
        // $this->middleware('role:tenant')->only(['staffMethod']);
        $this->middleware('role:tenant');
    }
    public function index(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $tenant_id = $user->tenant_id;
        $rents = Rent::where('tenant_id', $tenant_id)->orderBy('id', 'desc')->get();
        // dd($rent);
        return view('tenant.rent.index', compact('rents'));
    }

    public function new_rent()
    {

        return view('tenant.rent.create');
    }

    public function store(Request $request)
    {
        // logger($request);
        // return back()->with(['type' => 'success','title' => 'Success','message' => 'apartment Registered Successfully'], 200);
        // Get the current date and time
        $currentDateTime = Carbon::now();
        $expire_date = "";
        $validator = Validator::make($request->all(), [
            'payment_medium' => 'required',
            'proof' => 'required',
            'period' => 'required',
            'amount' => 'required'
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        // dd($user);

        if ($validator->fails()) {
            // logger("failed validation");

            return redirect('my-new-rent/')
                ->withErrors($validator)
                ->withInput();
        } else {
            // logger("passed validation");
            // if (Auth::user()->role == 'dev' || Auth::user()->role == 'admin') {
                $previous_expire_date = Carbon::now();

            if (Auth::user()->hasAnyRole('tenant')) {

                $apartment = Apartment::where('tenant_id', Auth::user()->tenant_id)->first();
                //get the last previous confirmed rent expiring date
                // dd($apartment);
                // $rent = Rent::where('tenant_id', Auth::user()->tenant_id)->get();
                $rent = Rent::where(['tenant_id' => Auth::user()->tenant_id, 'status' => "confirmed"])->latest('created_at')->first();
                // dd($rent);
                // if($rent->isNotEmpty()) {
                if(!empty($rent)) {
                    $previous_expire_date  = $rent->expire_date;
                    //check if the rent has not expired
                    if($previous_expire_date < now() ){
                        //if it has expired add more to the last expire date based on the period one paid for
                        // dd("expired");
                        // $expire_date = $previous_expire_date->copy()->addYears($request->get('period'))->toDateString();
                        $parsedDate = Carbon::parse($previous_expire_date);

                        // Add period years to the retrieved date
                        $updatedDate = $parsedDate->addYears($request->get('period'));

                        // Format the updated date back to the original format
                        $expire_date = $updatedDate->format('Y-m-d');
                        // dd($expire_date);
                    }
                    else{
                         //if it has not expired add more to the last expire date based on the period one paid for
                        // dd("not expired");
                        $parsedDate = Carbon::parse($previous_expire_date);

                        // Add period years to the retrieved date
                        $updatedDate = $parsedDate->addYears($request->get('period'));

                        // Format the updated date back to the original format
                        $expire_date = $updatedDate->format('Y-m-d');
                        // dd($expire_date);
                    }
                }
                else{
                    // that means its first rent of the tenant no previous rent
                    $expire_date = $currentDateTime->copy()->addYears($request->get('period'))->toDateString();

                    // dd($expire_date);
                }

                $rent = new Rent();
                $rent->payment_medium = $request->get('payment_medium');
                $rent->proof = $request->get('proof');
                $rent->amount = $request->get('amount');
                $rent->period = $request->get('period');
                $rent->tenant_id = $user->tenant_id;
                $rent->status = 'unconfirmed';
                $rent->expire_date = $expire_date;
                $rent->apartment_id = $apartment->id;
                if ($request->hasFile('proof')) {

                    $file = $request->file('proof');
                    $fileName = "Receipt" . time() . '.' . $file->getClientOriginalExtension();
                    // $fileName = time() . '.' . $request->image->extension();
                    $file->storeAs('public/images/payment_proof', $fileName);

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

    public function rent_amount(Request $request){
        if ($request->ajax()) {
            $period = $request->input('period');

            $apartment = Apartment::where('tenant_id', Auth::user()->tenant_id)->latest('created_at')->first();

            $total_amount = $apartment->rent * $period ;
            // logger($total_amount);
            $res = [
                'amount' => $total_amount,
            ];
            return json_encode($res);
        }
    }
}

