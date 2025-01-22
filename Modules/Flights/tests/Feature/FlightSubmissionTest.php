<?php

namespace Modules\Flights\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Modules\Users\Models\User;
use Modules\Flights\Models\Flight;

class FlightSubmissionTest extends TestCase
{
	use RefreshDatabase;
	
	public function setUp():void
	{
		parent::setUp();
		
		Artisan::call('migrate');
		
		Artisan::call('db:seed', ['--class' => 'DatabaseSeeder']);
		Artisan::call('db:seed', ['--class' => 'UserRoleSeeder']);
		
		User::create([
			'name' => 'John Does',
			'email' => 'john@does.com',
		]);
	}

	public function test_flight_submit_form_can_be_viewed(): void
	{
		($this->get('/flights/create'))->assertStatus(200);
	}
	
    public function test_members_can_submit_an_flight(): void
    {
       	$this->post(route('flights.store'), [
			'name' => 'John Does',
			'date' => '2025-01-21',
	        'start_time' => '15:00',
			'end_time' => '15:03',
			'model_type' => 1,
			'power_type' => 1,
			'rechapcha_custom' => 4,
		]);
		
		$this->assertDatabaseHas('flights', [
			'date' => '2025-01-21',
		]);
		
		$this->assertDatabaseHas('flight_user', [
			'user_id' => User::where('name', 'John Does')->first()->id,
		]);
    }
}
