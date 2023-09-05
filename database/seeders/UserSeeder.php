<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();

        $admin = User::create([
            'name' => "admin",
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin12345'),
        ]);


        $permissions = ['read', 'edit', 'create', 'delete'];

        // $client = User::create([
        //     'name' => 'Chris',
        //     'email' => 'chris@gmail.com',
        //     'phoneNumber' => '2347034118952',
        //     'role' =>'admin'
        // ]);

        $admin_role = $admin->assignRole('admin');

        foreach ($permissions as $permission) {
            $admin_role->givePermissionTo($permission);
        }

        $tenant = User::create([
            'name' => "tenant",
            'email' => 'tenant@tenant.com',
            'password' => Hash::make('tenant12345'),
        ]);

        $tenant_role = $tenant->assignRole('tenant');
        $tenant_role->givePermissionTo('read');

        Schema::enableForeignKeyConstraints();
    }
}
