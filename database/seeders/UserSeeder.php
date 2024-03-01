<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Develper',
                'email' => 'developer@gmail.com',
                'password' => Hash::make('adminpass@dev'),
            ],
            [
                'name' => 'Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('adminpass'),
            ],
        ];

        foreach ($userData as $data) {
            $user = User::create(array_merge($data, [
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]));

            $role = Role::find(1);
            $permissions = Permission::pluck('id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole($role);
        }
    }
}
