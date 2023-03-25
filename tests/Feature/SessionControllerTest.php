<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession()
    {
        $this->get('/session/create')->assertSeeText('OK')
            ->assertSessionHas('userId', 'eka')
            ->assertSessionHas('isMember', true);
    }

    public function testGetSession()
    {
        $this->withSession([
            'userId' => 'eka',
            'isMember' => 'true'
        ])->get('/session/get')
            ->assertSeeText('eka')->assertSeeText('true');
    }

    public function testGetSesiionFailed()
    {
        $this->withSession([])->get('/session/get')
            ->assertSeeText('guest')->assertSeeText('false');
    }
}
