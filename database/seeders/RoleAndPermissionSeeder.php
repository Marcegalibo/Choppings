<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleAndPermissionSeeder extends Seeder
{
   public function run()
   {
    $permissionsAdmin = [
        'users.index',
        'users.create',
        'users.store',
        'users.edit',
        'users.update',
        'users.destroy',
        'products.index',
        'products.create',
        'products.store',
        'products.edit',
        'products.update',
        'products.destroy',
        'categories.index',
        'categories.create',
        'categories.store',
        'categories.edit',
        'categories.update',
        'categories.destroy',
    ];
    //Roles
    $admin = Role::create(['name' => 'admin']);
    Role::create(['name' => 'user']);

    foreach ($permissionsAdmin as $permission) {
        $permission = Permission::create(['name' => $permission]);
        $admin->givePermissionTo($permission);
    }
   }
}
