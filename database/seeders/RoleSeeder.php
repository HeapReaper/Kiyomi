<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'management']);
        Role::create(['name' => 'junior_member']);
        Role::create(['name' => 'aspirant_member']);
        Role::create(['name' => 'member']);
        Role::create(['name' => 'donor']);
        Role::create(['name' => 'not_paid']);
        Role::create(['name' => 'webmaster']);
    }
}
