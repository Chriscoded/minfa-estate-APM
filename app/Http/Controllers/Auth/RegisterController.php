<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // logger($data);
        $tenant_id = isset($data['tenant_id']) ? $data['tenant_id']: null;
        // logger($tenant_id);
        //  dd($tenant_id);

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'tenant_id' => $data['tenant_id'],
            'password' => Hash::make($data['password']),

        ]);
        // logger('user');
        // logger($user);
        $tenantRole = Role::whereName('tenant')->first();
        $permissions = Permission::get();

        $tenantRole->givePermissionTo('read');
        $tenantRole->givePermissionTo('create');

        $user->assignRole('tenant');

        return $user;
    }

    protected function registered(Request $request, User $user)
    {
        if ($user->hasRole('admin')) {
            return redirect('/admin-dash');
        } elseif ($user->hasRole('tenant')) {
            return redirect('/tenant-dash');
        } else {
            return redirect(RouteServiceProvider::HOME);
        }
    }
}
