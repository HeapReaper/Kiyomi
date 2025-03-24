<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Users\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Default user',
            'email' => 'admin@default.com',
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);
    }
}
