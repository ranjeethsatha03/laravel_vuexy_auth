<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $superAdmin = User::where('email', 'superadmin@gmail.com')->first();

        if (!$superAdmin) {
            $superAdmin = User::create([
                'name' => 'super_admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('12345678'),
            ]);
        }
        $role = Role::where('name', 'super_admin')->first();
        $superAdmin->syncRoles(['super_admin']);
    }
}