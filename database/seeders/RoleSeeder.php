<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\role;
use Spatie\Permission\Models\Permission;
use Modules\Users\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates roles and given permissions
     *
     */
    public function run(): void
    {
        // Management
        $role = Role::create(['name' => 'management']);

        $permission = Permission::create(['name' => 'view management']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $permission = Permission::create(['name' => 'edit management']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $permission = Permission::create(['name' => 'delete management']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $user = User::find(1);
        $user->assignRole('management');

        // Member
        $role = Role::create(['name' => 'member']);

        $permission = Permission::create(['name' => 'view member panel']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $permission = Permission::create(['name' => 'view own flights']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $permission = Permission::create(['name' => 'view own profile']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);
    }
}
