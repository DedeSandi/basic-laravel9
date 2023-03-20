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
}
