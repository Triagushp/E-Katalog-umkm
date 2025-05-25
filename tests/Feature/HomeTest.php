<?php
// File: tests/Feature/HomeTest.php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_home_page_loads()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
