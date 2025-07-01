<?php

namespace Modules\Users\Tests\Feature;

use Hoa\Math\Visitor\Arithmetic;
use Illuminate\Support\Facades\Artisan;
use Modules\Users\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
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

        $this->post(route('users.store'), [
          'roles' => 'management',
          'name' => 'John Doe',
          'birthdate' => '26-03-2001',
          'address' => 'Test Address',
          'postcode' => '12345',
          'city' => 'Test City',
          'phone' => '0123456789',
          'email' => 'john@doe.com',
          'instruct' => 1,
        ]);

        $this->testuser = User::where('email', 'john@doe.com')->first();
    }

    public function test_user_can_log_in_and_is_redirected(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@default.com',
            'password' => 'admin',
        ]);

        $response->assertRedirect('/');
    }

    public function test_user_can_be_created(): void
    {
        $this->assertDatabaseHas('users', [
          'name' => 'John Doe',
        ]);

        $this->assertTrue($this->testuser->hasRole('management'));
    }

    public function test_user_has_role(): void
    {
        $user = User::where('email', 'john@doe.com')->first();
        $this->assertTrue($user->hasRole('management'));
    }

    public function test_members_can_be_updated(): void
    {
        $userToEdit = (User::where('name', 'John Doe')->first())->id;

        $response = $this->put(route('users.update', $userToEdit), [
            'name' => 'John Doe 2',
            'birthdate' => '01-01-2000',
            'address' => 'Test Address',
            'postcode' => '1234AA',
            'city' => 'Test City',
            'phone' => '0123456789',
            'email' => 'john@doe.com',
            'instruct' => 0,
            'rdw_number' => 'D469ch',
            'knvvl' => 'A492hdf',
            'roles' => 'member',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe 2',
        ]);

        $response->assertRedirect('/users');
    }
}
