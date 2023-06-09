<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UploadImageControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function testUploadMethodCanUploadImage()
    {
        $this->withoutExceptionHandling();
        $image = UploadedFile::fake()->image('image.png');

        $this
            ->actingAs(User::factory()->admin()->create())
            ->withHeaders([
                'HTTP_X-Requested-with' => 'XMLHttpRequest',
            ])
            ->postJson(route('upload'), compact('image'))
            ->assertOk()
            ->assertJson(['url' => "/upload/{$image->hashName()}"]);

        $this->assertFileExists(public_path("/upload/{$image->hashName()}"));
        $this->assertEquals(
            request()->route()->middleware(),
            ['web', 'admin']
        );
    }

    /**
     * @return void
     */
    public function testUploadMethodValidationRequestImageDataHasImageRule()
    {
        $image = UploadedFile::fake()->create('image.txt');

        $this
            ->actingAs(User::factory()->admin()->create())
            ->withHeaders([
                'HTTP_X-Requested-with' => 'XMLHttpRequest',
            ])
            ->postJson(route('upload'), compact('image'))
            ->assertJsonValidationErrors([
                'image' => 'The image field must be an image.',
            ]);

        $this->assertFileDoesNotExist(public_path("/upload/{$image->hashName()}"));
    }

    /**
     * @return void
     */
    public function testUploadMethodValidationRequestImageDataHasMaximumSizeRule()
    {
        $image = UploadedFile::fake()->create('image.png', 251);

        $this
            ->actingAs(User::factory()->admin()->create())
            ->withHeaders([
                'HTTP_X-Requested-with' => 'XMLHttpRequest',
            ])
            ->postJson(route('upload'), compact('image'))
            ->assertJsonValidationErrors([
                'image' => 'The image field must not be greater than 250 kilobytes.',
            ]);

        $this->assertFileDoesNotExist(public_path("/upload/{$image->hashName()}"));
    }

    /**
     * @return void
     */
    public function testUploadMethodValidationRequestImageDataHasMaximumDimensionsRule()
    {
        $image = UploadedFile::fake()
            ->image('image.png', 101, 201)
            ->size(50);

        $this
            ->actingAs(User::factory()->admin()->create())
            ->withHeaders([
                'HTTP_X-Requested-with' => 'XMLHttpRequest',
            ])
            ->postJson(route('upload'), compact('image'))
            ->assertJsonValidationErrors([
                'image' => 'The image field has invalid image dimensions.',
            ]);

        $this->assertFileDoesNotExist(public_path("/upload/{$image->hashName()}"));
    }
}
