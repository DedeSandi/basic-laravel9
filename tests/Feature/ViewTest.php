<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')->assertStatus(200)->assertSeeText('Hello Dede');
        $this->get('/hello-again')->assertStatus(200)->assertSeeText('Hello Dede');
        $this->get('/halo')->assertSeeText('Halo Dede');
    }

    public function testViewWithOutRoute()
    {
        $this->view('hello', ['name' => 'Dede'])->assertSeeText('Hello Dede');
        $this->view('hello.world', ['name' => 'Dede'])->assertSeeText('Halo Dede');
    }
}
