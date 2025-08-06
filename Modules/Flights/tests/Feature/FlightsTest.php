<?php

namespace Modules\Flights\Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Modules\Users\Models\User;
use Tests\TestCase;
use Modules\Flights\Enums\ModelTypeEnum;
use Modules\Flights\Enums\ModelPowerClassEnum;

class FlightsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('key:generate');

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed', ['--class' => 'RoleSeeder']);
        Artisan::call('db:seed', ['--class' => 'PermissionSeeder']);
        Artisan::call('db:seed', ['--class' => 'DefaultUserSeeder']);
        Artisan::call('db:seed', ['--class' => 'LicenceSeeder']);
    }

    public function test_if_flights_can_be_viewed(): void
    {
        ($this->get('/flights/create'))->assertStatus(200);
    }

    public function disabled_if_flights_can_be_submitted(): void
    {
        User::firstOrCreate(
            ['name' => 'John Doe'],
            [
                'birthdate' => '01-01-2000',
                'address' => 'Test Address',
                'postcode' => '1234AB',
                'city' => 'Test City',
                'phone' => '06123456780',
                'email' => 'john@doe.com',
                'rdw_number' => 'frwe3443tfg',
                'knvvl' => '324234',
                'roles' => 'member'
            ]
        );

        $response = $this->post(route('flights.store'), [
            'name' => 'John Doe',
            'date' => '2025-08-06',
            'start_time' => '10:52',
            'end_time' => '10:57',
            'model_type' => ModelTypeEnum::HELICOPTER,
            'power_type' => ModelPowerClassEnum::MEDIUM,
            'rechapcha_custom' => 4,
        ]);

        $response->dump();

        $this->assertDatabaseHas('flights', [
            'date' => '2025-08-06',
        ]);

        $this->assertDatabaseHas('flight_user', [
            'user_id' => User::where('name', 'John Doe')->first()->id,
        ]);
    }
}
