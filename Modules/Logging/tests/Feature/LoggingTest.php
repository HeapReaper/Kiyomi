<?php

namespace Modules\Logging\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Livewire\Livewire;
use Modules\Users\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LoggingTest extends TestCase
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

        (User::where('email', 'admin@default.com')->first())->assignRole(Role::findByName('management'));

        \App\Helpers\Settings::insertOrUpdate('roles_allowed_sign_in', 'management,webmaster');

        // Log in the admin user first
        Livewire::test('users::signin')
            ->set('email', 'admin@default.com')
            ->set('password', 'admin')
            ->call('submit');
        $this->assertAuthenticatedAs(auth()->user());
    }
    public function test_the_application_returns_a_successful_response(): void
    {
        ($this->get('/logging'))->assertStatus(200);
    }

    public function test_can_write_to_user_error_log_file(): void
    {
        Log::channel('user_error')->info('Test log message');

        $logContent = file_get_contents(base_path('storage/logs/user_error.log'));
        $this->assertStringContainsString('Test log message', $logContent);
    }

    public function test_can_write_to_acces_log_file(): void
    {
        Log::channel('access')->info('Test log message');
        $logContent = file_get_contents(base_path('storage/logs/access.log'));
        $this->assertStringContainsString('Test log message', $logContent);
    }
}
