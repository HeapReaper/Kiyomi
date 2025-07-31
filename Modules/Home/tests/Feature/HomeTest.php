<?php

namespace Modules\Home\Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
