<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_login()
    {
        $response = $this->post('/login');
        $response->assertStatus(200);
    }

    public function test_register()
    {
        $response = $this->post('/register');
        $response->assertStatus(200);
    }

    public function test_timetables()
    {
        $response = $this->post('/get-time-tables');
        $response->assertStatus(200);
    }

    
}
