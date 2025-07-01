<?php

namespace Modules\Settings\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Livewire\Livewire;
use Modules\Users\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;


class SettingsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
        Artisan::call('key:generate');

        Artisan::call('db:seed', ['--class' => 'RoleSeeder']);
        Artisan::call('db:seed', ['--class' => 'PermissionSeeder']);
        Artisan::call('db:seed', ['--class' => 'DefaultUserSeeder']);
        Artisan::call('db:seed', ['--class' => 'LicenceSeeder']);

        $user = User::where('email', 'admin@default.com')->first();
        $user->assignRole(Role::findByName('management'));

        \App\Helpers\Settings::insertOrUpdate('roles_allowed_sign_in', 'management, webmaster');

        $this->actingAs($user, 'web');
    }

    public function test_can_show_settings(): void
    {
        ($this->get(route('settings.index')))->assertStatus(200);
    }

    public function test_can_change_settings(): void
    {
        $this->post(route('settings.store'), [
            'email_new_members' => 'john@doe.com',
            'roles' => ['management', 'webmaster', 'member'],
        ]);

        $this->assertDatabaseHas('settings', [
            'name' => 'email_new_members',
            'value' => 'john@doe.com',
        ]);

        $this->assertDatabaseHas('settings', [
            'name' => 'roles_allowed_sign_in',
            'value' => 'management,webmaster,member',
        ]);
    }
}
