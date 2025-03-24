<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Users\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Roles creation
        $managementRole = Role::create(['name' => 'management']);
        $juniorRole = Role::create(['name' => 'junior_member']);
        $aspirantRole = Role::create(['name' => 'aspirant_member']);
        $memberRole = Role::create(['name' => 'member']);
        $donorRole = Role::create(['name' => 'donor']);
        $notPaidRole = Role::create(['name' => 'not_paid']);
        $superAdminRole = Role::create(['name' => 'super admin']);

        // Flights permissions
        $flightsViewPermission = Permission::create(['name' => 'view flights']);
        $flightsEditPermission = Permission::create(['name' => 'edit flights']);
        $flightsDeletePermission = Permission::create(['name' => 'delete flights']);
        $flightsViewStatisticsPermission = Permission::create(['name' => 'view flights statistics']);
        $flightsViewFlightReportsPermission = Permission::create(['name' => 'view flights reports']);
        $flightsCreateFlightsReportsPermission = Permission::create(['name' => 'create flights reports']);
        $flightsDeleteFlightsReportsPermission = Permission::create(['name' => 'delete flights reports']);
        $flightsDownloadFlighsReportsPermission = Permission::create(['name' => 'download flights reports']);

        // Members permissions
        $membersViewPermission = Permission::create(['name' => 'view members']);
        $membersCreatePermission = Permission::create(['name' => 'create members']);
        $membersEditPermission = Permission::create(['name' => 'edit members']);
        $membersDeletePermission = Permission::create(['name' => 'delete members']);
        $membersViewStatisticsPermission = Permission::create(['name' => 'view members statistics']);
        $membersViewContactPermission = Permission::create(['name' => 'view members contact']);
        $membersCreateContactPermission = Permission::create(['name' => 'create members contact']);
        $membersViewExportPermission = Permission::create(['name' => 'view members export']);
        $membersCreateExportPermission = Permission::create(['name' => 'create members export']);
        $membersDeleteExportPermission = Permission::create(['name' => 'delete members export']);
        $membersDownloadExportPermission = Permission::create(['name' => 'download members export']);

        // Finance permissions
        $financeViewPermission = Permission::create(['name' => 'view finance']);
        $financeDownloadPermission = Permission::create(['name' => 'download finance']);
        $financeCreatePermissions = Permission::create(['name' => 'create finance']);

        // Settings permissions
        $settingsViewPermission = Permission::create(['name' => 'view settings']);
        $settingsEditPermission = Permission::create(['name' => 'edit settings']);

        // System permissions
        $systemViewPermission = Permission::create(['name' => 'view system']);
        $systemCreatePermission = Permission::create(['name' => 'create system']);
        $systemDeletePermission = Permission::create(['name' => 'delete system']);

        // Wildcard permission
        // Assigning permissions to roles
        // Management
        $managementRole->givePermissionTo([
            $flightsViewPermission,
            $flightsEditPermission,
            $flightsDeletePermission,
            $flightsViewStatisticsPermission,
            $flightsViewFlightReportsPermission,
            $flightsCreateFlightsReportsPermission,
            $flightsDeleteFlightsReportsPermission,
            $flightsDownloadFlighsReportsPermission,
            $membersViewPermission,
            $membersCreatePermission,
            $membersEditPermission,
            $membersDeletePermission,
            $membersViewStatisticsPermission,
            $membersViewContactPermission,
            $membersCreateContactPermission,
            $membersViewExportPermission,
            $membersCreateExportPermission,
            $membersDeleteExportPermission,
            $membersDownloadExportPermission,
            $financeViewPermission,
            $financeDownloadPermission,
            $financeCreatePermissions,
            $settingsViewPermission,
            $settingsEditPermission,
            $systemViewPermission,
            $systemCreatePermission,
            $systemDeletePermission,
        ]);
    }
}
