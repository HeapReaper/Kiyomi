<?php

namespace Modules\Users\Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Modules\Users\Models\User;
use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
	use RefreshDatabase;
	
	public function setUp(): void
	{
		parent::setUp();
		Artisan::call('migrate');
		
		Artisan::call('db:seed', ['--class' => 'DatabaseSeeder']);
		Artisan::call('db:seed', ['--class' => 'UserRoleSeeder']);
		
		// sign in user for tests below
		Livewire::test('users::signin')
			->set('email', 'admin@default.com')
			->set('password', 'admin')
			->call('submit');
		
		$this->assertAuthenticatedAs(User::find(1));
	}
	
    public function test_users_can_log_in(): void
	{
		$user = User::find(1);
		
		$this->assertNotNull($user);
		
		$response = Livewire::test('users::signin')
			->set('email', 'admin@default.com')
			->set('password', 'admin')
			->call('submit');

		$this->assertAuthenticatedAs($user);

		$response->assertRedirect('/panel');
	}
	
	public function test_members_can_be_created(): void
	{
		$response = $this->post(route('users.store'), [
			'role' => 'member',
			'name' => 'John Doe',
			'birthdate' => '01-01-2000',
			'address' => 'Test Address',
			'postcode' => '12345',
			'city' => 'Test City',
			'phone' => '0123456789',
			'email' => 'john@doe.com',
			'instruct' => 0,
		]);
		
		$this->assertDatabaseHas('users', [
			'name' => 'John Doe',
		]);
		
		$response->assertRedirect('/users');
	}
	
	public function test_members_can_be_updated(): void
	{
		$userToEdit = (User::where('name', 'Default user')->first())->id;
		
		$response = $this->put(route('users.update', $userToEdit), [
			'name' => 'John Doe 2',
			'birthdate' => '01-01-2000',
			'address' => 'Test Address',
			'postcode' => '1234AA',
			'city' => 'Test City',
			'phone' => '0123456789',
			'email' => 'john@doe2.com',
			'instruct' => 0,
			'rdw_number' => 'rfsjregre',
			'knvvl' => 'wdeqfdwe',
			'role' => 'member',
		]);
		
		$this->assertDatabaseHas('users', [
			'name' => 'John Doe 2',
		]);
		
		$response->assertRedirect('/users');
	}
}
