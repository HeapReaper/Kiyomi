<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Users\Models\User;
use Spatie\Permission\Models\Role;


class DefaultUserSeeder extends Seeder
{
    public function run(): void
    {
        // Allow role to sign in
        \App\Helpers\Settings::insertOrUpdate('roles_allowed_sign_in', 'management');

        $user = User::create([
            'name' => 'Default user',
            'email' => 'admin@default.com',
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole(Role::findByName('management'));
    }
}
