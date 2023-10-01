<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'read']);

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('create');
        $adminRole->givePermissionTo('edit');
        $adminRole->givePermissionTo('delete');
        $adminRole->givePermissionTo('read');


        $userRole = Role::create(['name' => 'staff']);
        $userRole->givePermissionTo('read');
        $userRole->givePermissionTo('create');

        $userRole = Role::create(['name' => 'administrator']);
        $userRole->givePermissionTo('read');
        $userRole->givePermissionTo('create');

        $userRole = Role::create(['name' => 'Tenant']);
        $userRole->givePermissionTo('read');
        $userRole->givePermissionTo('create');

    }
}
