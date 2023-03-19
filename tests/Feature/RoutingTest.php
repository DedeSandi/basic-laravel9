<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    // 
    public function testGet()
    {
       $this->get('/test')->assertStatus(200)->assertSeeText('Hello World');
    }

 
    public function testRedirect()
    {
        $this->get('/lempar')->assertRedirect('/test');
    }

    public function testFallback()
    {
       $this->get('/UrlYangTidakAda')->assertStatus(200)->assertSeeText('404 - Halaman Tidak ditemukan');
    }
}
