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

        // Junior member
        $role = Role::create(['name' => 'junior_member']);

        $permission = Permission::create(['name' => 'view member panel']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $permission = Permission::create(['name' => 'view own flights']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $permission = Permission::create(['name' => 'view own profile']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        // Aspirant member
        $role = Role::create(['name' => 'aspirant_member']);

        $role->givePermissionTo('view member panel');
        $permission->assignRole($role);

        $role->givePermissionTo('view own flights');
        $permission->assignRole($role);

        $role->givePermissionTo('view own profile');
        $permission->assignRole($role);

        // Member
        $role = Role::create(['name' => 'member']);

        $role->givePermissionTo('view member panel');
        $permission->assignRole($role);

        $role->givePermissionTo('view own flights');
        $permission->assignRole($role);

        $role->givePermissionTo('view own profile');
        $permission->assignRole($role);

        // Donor
        $role = Role::create(['name' => 'donor']);

        $role->givePermissionTo('view member panel');
        $permission->assignRole($role);

        $role->givePermissionTo('view own flights');
        $permission->assignRole($role);

        $role->givePermissionTo('view own profile');
        $permission->assignRole($role);

        // Non paid
        $role = Role::create(['name' => 'not_paid']);

        $role->givePermissionTo('view own profile');
        $permission->assignRole($role);
    }
}
