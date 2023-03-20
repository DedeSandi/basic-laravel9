<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testRouteToController()
    {
        $this->get('hello/dede')->assertSeeText('Halo dede');
        $this->get('say/eka')->assertSeeText('Halo eka');
    }

    public function testRequest()
    {
        $this->get('request', ['Accept' => 'plain/text'])->assertSeeText('request')->assertSeeText("http://localhost/request")->assertSeeText('GET')->assertSeeText('plain/text');
    }
}
