<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Users\Models\User;
use Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
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
