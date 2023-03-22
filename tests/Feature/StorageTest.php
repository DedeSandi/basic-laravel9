<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StorageTest extends TestCase
{
    public function testStorage()
    {
        $fileSystem = Storage::disk('local');
        $fileSystem->put('file.txt', 'Hello World');
        $content = $fileSystem->get('file.txt');

        self::assertEquals('Hello World', $content);
    }
    public function testPublic()
    {
        $fileSystem = Storage::disk('public');
        $fileSystem->put('file.txt', 'Hello World');
        $content = $fileSystem->get('file.txt');

        self::assertEquals('Hello World', $content);
    }
}
