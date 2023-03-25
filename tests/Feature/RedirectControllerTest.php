<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    public function testRedirect()
    {
        $this->get('/redirect/from')
            ->assertRedirect('/redirect/to');
    }

    public function testRedirectNamedRoute()
    {
        $this->get('/redirect/name')
            ->assertRedirect('/redirect/name/dede');
    }

    public function testRedirectControllerAction()
    {
        $this->get('/redirect/action')
            ->assertRedirect('/redirect/name/eka');
    }

    public function testRedirectExternalDomain()
    {
        $this->get('/redirect/away')
            ->assertRedirect('https://www.udemy.com');
    }
}
