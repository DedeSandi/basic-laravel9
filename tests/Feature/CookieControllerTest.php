<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
            ->assertCookie('User-Id', 'Dede')
            ->assertCookie('Is-Member', 'true');
    }

    public function testGetCookie()
    {
        $this->withCookie('User-Id', 'Dede')
            ->withCookie('Is-Member', 'true')
            ->get('/cookie/get')
            ->assertStatus(200)
            ->assertJson(['userId' => 'Dede', 'isMember' => 'true']);
    }
    public function testClearCookie()
    {
        $this->get('/cookie/clear')
            ->assertCookieExpired('User-Id')
            ->assertCookieExpired('Is-Member');
    }
}
