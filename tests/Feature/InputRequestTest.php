<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputRequestTest extends TestCase
{
    public function testInputController()
    {
        $this->get('/say-hello?name=dede')->assertSeeText('Hello dede');
        $this->post('/say-hello', ['name' => 'dede'])->assertSeeText('Hello dede');
    }

    public function testNestedInput()
    {
        $this->post('/hello-first', [
            'name' => [
                'first' => 'dede',
                'last' => 'eka',
            ],
        ])->assertSeeText('Hello dede eka');
    }

    public function testAllInput()
    {
        $this->post('/hello-input', [
            'name' => [
                'first' => 'dede',
                'last' => 'eka',
            ],
        ])->assertSeeText('name')->assertSeeText('first')->assertSeeText('dede')->assertSeeText('last')->assertSeeText('eka');
    }

    public function testArrayInput()
    {
        $this->post('/input-array', [
            'products' => [
                [
                    'name' => 'kayu',
                    'warna' => 'coklat'
                ],
                [
                    'name' => 'batu',
                    'warna' => 'hitam'
                ]
            ],
        ])->assertSeeText('kayu')->assertSeeText('batu');
    }

    public function testInputType()
    {
        $this->post(
            '/input/input-type',
            [
                'name' => 'budi',
                'married' => 'true',
                'birth_date' => '1990-10-19'
            ],
        )->assertSeeText('budi')->assertSeeText('true')->assertSeeText('1990-10-19');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter-only', [
            'name' => [
                'first' => 'dede',
                'last' => 'eka',
                'age' => '25'
            ],
        ])->assertSeeText('dede')->assertSeeText('eka')->assertDontSeeText('25');
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter-except', [
            'user' => [
                'first' => 'dede',
                'last' => 'eka',
                'admin' => 'true'
            ],
        ])->assertSeeText('dede')->assertSeeText('eka')->assertDontSeeText('true');
    }
    public function testFilterMerge()
    {
        $this->post('/input/filter-merge', [
            'user' => [
                'first' => 'dede',
                'last' => 'eka',
                'admin' => 'true'
            ],
        ])->assertSeeText('dedse')->assertSeeText('eka')->assertSeeText('false');
    }
}
