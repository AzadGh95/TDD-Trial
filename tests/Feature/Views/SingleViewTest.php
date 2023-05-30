<?php

namespace Tests\Feature\Views;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SingleViewTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_single_view_rendered_when_user_logged_in()
    {
        $post = Post::factory()->create();
        $comments = [];

        $view = (string) $this
            ->actingAs(User::factory()->create())
            ->view(
                'single',
                compact('post', 'comments')
            );

        $dom = new \DOMDocument();
        $dom->loadHTML($view);
        $dom = new \DOMXPath($dom);

        $action = route('single.comment', $post->id);

        $this->assertCount(
            1,
            $dom->query("//form[@method='POST'][@action='$action']/textarea[@name='text']")
        );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_single_view_rendered_when_user_not_logged_in()
    {
        $post = Post::factory()->create();
        $comments = [];

        $view = (string) $this
            ->view(
                'single',
                compact('post', 'comments')
            );

        $dom = new \DOMDocument();
        $dom->loadHTML($view);
        $dom = new \DOMXPath($dom);

        $action = route('single.comment', $post->id);

        $this->assertCount(
            0,
            $dom->query("//form[@method='post'][@action='$action']/textarea[@name='text']")
        );
    }
}
