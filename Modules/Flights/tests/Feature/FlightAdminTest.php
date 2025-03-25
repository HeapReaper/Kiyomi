<?php

namespace Modules\Flights\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Livewire\Livewire;
use Modules\Users\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class FlightAdminTest extends TestCase
{
    use refreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('key:generate');

        Artisan::call('db:seed', ['--class' => 'RoleSeeder']);
        Artisan::call('db:seed', ['--class' => 'PermissionSeeder']);
        Artisan::call('db:seed', ['--class' => 'DefaultUserSeeder']);
        Artisan::call('db:seed', ['--class' => 'LicenceSeeder']);

        (User::find(1))->assignRole(Role::findByName('management'));

        \App\Helpers\Settings::insertOrUpdate('roles_allowed_sign_in', 'management, webmaster');

        // Log in the admin user first
        Livewire::test('users::signin')
            ->set('email', 'admin@default.com')
            ->set('password', 'admin')
            ->call('submit');
        $this->assertAuthenticatedAs(auth()->user());

        $this->post(route('users.store'), [
            'roles' => 'management',
            'name' => 'John Doe',
            'birthdate' => '01-01-2000',
            'address' => 'Test Address',
            'postcode' => '12345',
            'city' => 'Test City',
            'phone' => '0123456789',
            'email' => 'john@doe.com',
            'instruct' => 1,
        ]);

        $this->testuser = User::where('email', 'john@doe.com')->first();

        $this->testuser->assignRole('management');
    }

    public function test_can_view_flights_overview(): void
    {
        ($this->get(route('flights-panel.index')))->assertStatus(200);
    }

    public function test_can_view_flights_statistics(): void
    {
        ($this->get(route('flights-statistics.index')))->assertStatus(200);
    }

    public function test_can_view_flights_reports(): void
    {
        ($this->get(route('flights-report.index')))->assertStatus(200);
    }
}
