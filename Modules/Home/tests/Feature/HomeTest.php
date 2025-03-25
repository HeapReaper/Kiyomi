<?php

namespace Modules\Home\Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class HomeTest extends TestCase
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
    }


    public function test_homepage_can_be_viewed(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
