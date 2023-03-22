<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    public function testUpload()
    {
        $image = UploadedFile::fake()->image('dede.png');

        $this->post('/file/upload', [
            'picture' => $image
        ])->assertSeeText('OK : dede.png');
    }
}
