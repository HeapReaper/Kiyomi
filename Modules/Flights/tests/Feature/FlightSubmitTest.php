<?php

namespace Modules\Flights\Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Modules\Users\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class FlightSubmitTest extends TestCase
{
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

        $this->testuser = User::create([
            'roles' => 'member',
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
        $this->testuser->assignRole('member');
    }

    public function test_flight_submit_form_can_be_viewed(): void
    {
        ($this->get('/flights/create'))->assertStatus(200);
    }

    public function test_can_submit_new_flights(): void
    {
        $resp = $this->post(route('flights.store'), [
            'name' => 'John Doe',
            'date' => date('Y-m-d'),
            'start_time' => '15:00',
            'end_time' => '15:03',
            'model_type' => 1,
            'power_type' => 1,
            'rechapcha_custom' => 4,
        ]);

        $this->assertDatabaseHas('flights', [
            'date' => date('Y-m-d'),
        ]);

        $this->assertDatabaseHas('flight_user', [
            'user_id' => User::where('name', 'John Doe')->first()->id,
        ]);
    }
}
