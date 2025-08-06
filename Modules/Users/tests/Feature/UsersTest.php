<?php

namespace Modules\Users\Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Livewire\Livewire;
use Modules\Users\Models\User;
use Tests\TestCase;

class UsersTest extends TestCase
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

    public function test_if_users_can_visit_login(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_if_users_can_login(): void
    {
        Livewire::test('users::signin')
            ->set('email', 'admin@default.com')
            ->set('password', 'admin')
            ->call('submit');

        $this->assertAuthenticatedAs(User::find(1));
    }

    public function test_if_users_can_logout(): void
    {
        $this->get('/logout');

        $this->assertGuest();
    }

    public function test_if_users_can_be_created(): void
    {
        $this->actingAs(User::find(1));

        $response = $this->post(route('users.store'), [
            'roles'       => 'member',
            'name'       => 'John Doe',
            'birthdate'  => '01-01-2000',
            'address'    => 'Test Address',
            'postcode'   => '1234AB',
            'city'       => 'Test City',
            'phone'      => '06123456780',
            'email'      => 'john@doe.com',
            'rdw_number' => 'frwe3443tfg',
            'knvvl'      => '324234',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
        ]);

        $response->assertRedirect('/users');
    }

    public function test_if_users_can_be_edited(): void
    {
        $this->actingAs(User::find(1));

        $user = User::firstOrCreate(
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

        $response = $this->put(route('users.update', $user->id), [
            'name' => 'John Doe 2',
            'birthdate' => '01-01-2000',
            'address' => 'Test Address',
            'postcode' => '1234AB',
            'city' => 'Test City',
            'phone' => '06123456780',
            'email' => 'john@doe.com',
            'rdw_number' => 'frwe3443tfg',
            'knvvl' => '324234',
            'roles' => 'member'
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe 2',
        ]);

        $response->assertRedirect('/users');
    }

    public function test_if_users_can_be_deleted(): void
    {
        $this->actingAs(User::find(1));

        $user = User::firstOrCreate(
            ['name' => 'John Doe 2'],
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

        $response = $this->delete(route('users.destroy', $user->id));

        $this->assertDatabaseMissing('users', [
            'name' => 'John Doe 2',
        ]);

        $response->assertRedirect('/users');
    }
}
