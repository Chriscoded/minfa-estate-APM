<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expenses;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ExpensesController extends Controller
{
    public function index()
    {
        $expenses = Expenses::orderBy('created_at', 'desc')->with('apartment')->get();
        // $rents = Rent::with('tenant')->with('apartment')->get();
        return View('admin.expenses.index', compact('expenses'));
    }

    public function create()
    {
        $apartments = Apartment::get();
        // dd($apartments);
        return view('admin.expenses.create', compact('apartments'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // logger($request);
        $validator = Validator::make($request->all(), [
            'apartment_no' => 'required',
            'amount' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('new-apartment/')
                ->withErrors($validator)
                ->withInput();
        } else {
            if (Auth::user()->hasRole('dev') || Auth::user()->hasRole('admin')) {

                $expense = new Expenses();
                Expenses::create([
                    "apartment_no" => $request->get('apartment_no'),
                    "amount" => $request->get('amount'),
                    "description" => $request->get('description')
                ]);

                // $expense->apartment_no = $request->get('apartment_no');
                // $expense->amount = $request->get('amount');
                // $expense->description = $request->get('description');
                // $expense->save();

                return back()->with(['type' => 'success','title' => 'Success','message' => 'Expense stored Successfully'], 200);
            } else {
                // flash()->error('Add Tenant fail!, Duplicate email or Invalid credentials');
                // return back();

                return back()->with(['type' => 'error','title' => 'Error','message' => 'Expense storage fail!'], 422);
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

    public function destroy($id)
    {
        $expense = Expenses::where('id', $id)->first();
        $expense->delete();
        // return back()->with(['success' => 'Expense Deleted Successfully'], 200);
        return back()->with(['type' => 'success','title' => 'Success','message' => 'Expense Deleted Successfully'], 200);
    }


}
