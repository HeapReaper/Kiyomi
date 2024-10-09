<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Users\Models\User;
use Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Default user',
            'email' => 'admin@default.com',
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);

        $this->call([DefaultUserSeedSeeder::class]);
    }
}
