<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_post_insert(): void
    {
        $data = Post::factory()->make()->toArray();

        Post::create($data);

        $this->assertDatabaseHas('posts', $data);
    }
}
