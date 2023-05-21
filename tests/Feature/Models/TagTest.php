<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_tag_insert(): void
    {
        $data = Tag::factory()->make()->toArray();

        Tag::create($data);

        $this->assertDatabaseHas('tags', $data);
    }

    public function test_tag_relationship_with_post()
    {
        $count = rand(1, 10);
        $tag = Tag::factory()
            ->hasPosts($count)
            ->create();

        $this->assertCount($count, $tag->posts);
        $this->assertTrue($tag->posts->first() instanceof Post);
    }
}
