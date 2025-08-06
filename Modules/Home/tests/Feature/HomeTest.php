<?php

namespace Modules\Home\Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_if_home_returns_successful_response(): void
    {
        Artisan::call('key:generate');

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
