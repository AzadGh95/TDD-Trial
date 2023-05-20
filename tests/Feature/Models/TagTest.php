<?php

namespace Tests\Feature\Models;

use App\Models\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $data = Tag::factory()->make()->toArray();

        Tag::create($data);

        $this->assertDatabaseHas('tags', $data);
    }
}
