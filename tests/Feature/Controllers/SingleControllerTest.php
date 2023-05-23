<?php

namespace Tests\Feature\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SingleControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index_method(): void
    {
        $post = Post::factory()->hasComments(rand(0, 3))->create();
        $response = $this->get(route('single', $post->id));
        
        $response->assertOk();
        $response->assertViewIs('single');
        $response->assertViewHasAll(
            [
                'post' => $post,
                'comments' => $post->comments()->latest()->paginate()
            ]
        );

        $response->assertStatus(200);
    }
}
