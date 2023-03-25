<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    public function testInvalid()
    {
        $this->get('/middleware/api')->assertStatus(401)
            ->assertSeeText('Access Denied');
    }
    public function testValid()
    {
        $this->withHeader('X-API-KEY', 'EKA')
            ->get('/middleware/api')->assertStatus(200)
            ->assertSeeText('OK');
    }

    public function testGroupInvalid()
    {
        $this->get('/middleware/group')->assertStatus(401)
            ->assertSeeText('Access Denied');
    }
    public function testGroupValid()
    {
        $this->withHeader('X-API-KEY', 'EKA')
            ->get('/middleware/group')->assertStatus(200)
            ->assertSeeText('Group');
    }
}
