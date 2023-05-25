<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    // public function test_insert_data(): void
    // {
    //     User::factory()->create();

    //     $this->assertDatabaseCount('users', 1);
    // }

    // public function test_insert_data_2(): void
    // {
    //     $data = User::factory()->make()->toArray();
    //     $data['password'] = 123456;
    //     User::create($data);
    //     $this->assertDatabaseHas('users', $data);
    // }

    public function test_user_relationship_with_post()
    {
        $count = rand(1, 10);
        $user = User::factory()
            ->hasPosts($count)
            ->create();

        $this->assertCount($count, $user->posts);
        $this->assertTrue($user->posts->first() instanceof Post);
    }

    public function test_user_relationship_with_comment()
    {
        $count = rand(1, 10);

        $user = User::factory()
            ->hasComments($count)
            ->create();

        $this->assertCount($count, $user->comments);
        $this->assertTrue($user->comments->first() instanceof Comment);
    }
}
