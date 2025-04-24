<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Users\Models\User;
use Spatie\Permission\Models\Role;

class DefaultUserSeeder extends Seeder
{
    public function run(): void
    {
        // Allow roles to sign in
        \App\Helpers\Settings::insertOrUpdate('roles_allowed_sign_in', 'management, webmaster');

        $user = User::create([
            'birthdate' => '1990-01-01',
            'address' => 'Default address',
            'zip_code' => '1234AB',
            'city' => 'DefaultCity',
            'mobile_phone' => '0612345678',
            'name' => 'Default user',
            'email' => 'admin@default.com',
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole(Role::findByName('webmaster'));
    }
}
