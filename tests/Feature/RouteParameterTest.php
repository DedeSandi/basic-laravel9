<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteParameterTest extends TestCase
{
    public function testRouteParam()
    {
        $this->get('/products/1')->assertStatus(200)->assertSeeText("Product Id : 1");
        $this->get('/products/1/items/XXX')->assertStatus(200)->assertSeeText("product : 1| items : XXX");
    }

    public function testRouteParamRegex()
    {
        $this->get('/items/1')->assertSeeText("item ID : 1");
        $this->get('/items/78')->assertSeeText("item ID : 78");
        $this->get('/items/huruf')->assertSeeText("404 - Halaman Tidak ditemukan");
    }

    public function testOpsiRouteParam()
    {
        $this->get('/categories')->assertSeeText("category : 404");
        $this->get('/categories/22')->assertSeeText("category : 22");
    }

    public function testNamedRoute()
    {
        $this->get('/pengguna/12345')->assertSeeText("link : http://localhost/user/12345");
        $this->get('/pengguna-redirect/12345')->assertRedirect("user/12345");
    }
}
