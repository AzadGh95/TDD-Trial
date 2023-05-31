<?php

namespace Tests\Feature\Models;

use App\Helpers\DurationOfReading;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase, ModelHelperTesting;

    protected function model(): Model
    {
        return new Post();
    }

    public function test_post_relationship_with_user()
    {
        $post = Post::factory()
            ->for(User::factory())
            ->create();

        $this->assertTrue(isset($post->user->id));
        $this->assertTrue($post->user instanceof User);
    }

    public function test_post_relationship_with_tag()
    {
        $count = rand(1, 10);

        $post = Post::factory()
            ->hasTags($count)
            ->create();

        $this->assertCount($count, $post->tags);
        $this->assertTrue($post->tags->first() instanceof Tag);
    }

    public function test_post_relationship_with_comment()
    {
        $count = rand(1, 10);

        $post = Post::factory()
            ->hasComments($count)
            ->create();

        $this->assertCount($count, $post->comments);
        $this->assertTrue($post->comments->first() instanceof Comment);
    }

    public function testGetReadingDurationAttribute()
    {
        $post = Post::factory()->make();

        $dor = new DurationOfReading();
        $dor->setText($post->description);

        $this->assertEquals($post->readingDuration, $dor->getTimePerMinute());
    }

    public function testGetReadingDurationAttributeWithMocking()
    {
        $post = Post::factory()->make();

        $mock = $this->mock(DurationOfReading::class, function (MockInterface $mock) use ($post) {
            $mock
                ->shouldReceive('setText')
                ->with($post->description)
                ->once()
                ->andReturn($mock);

            $mock
                ->shouldReceive('getTimePerMinute')
                ->once()
                ->andReturn(20);
        });

        $this->assertEquals(20, $post->readingDuration);
    }
}
