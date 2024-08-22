<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create roles or retrieve existing ones
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);

        // Define permissions
        $permissions = [
            'create role',
            'view role',
            'update role',
            'delete role',
            'create user',
            'view user',
            'update user',
            'delete user',
            'create payment setting',
            'view payment setting',
            'update payment setting',
            'delete payment setting'
        ];

        // Create permissions or retrieve existing ones
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $superAdminRole->permissions()->sync(Permission::all());
    }
}
