<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $data = Comment::factory()->make()->toArray();

        Comment::create($data);

        $this->assertDatabaseHas('comments', $data);
    }
}
