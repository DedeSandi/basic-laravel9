<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')->assertStatus(200)->assertSeeText('Hello Response');
    }
    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('dede')->assertSeeText('eka')
            ->assertHeader('Content-Type', 'aplication/json')
            ->assertHeader('Author', 'Dede Sandi')
            ->assertHeader('App', 'Belajar Laravel');
    }

    public function testView()
    {
        $this->get('/response/type/view')->assertStatus(200)->assertSeeText('Hello dede');
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertStatus(200)
            ->assertJson(['firstName' => 'dede', 'lastName' => 'eka']);
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'image/png');
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertStatus(200)
            ->assertDownload('dede.png');
    }
}
