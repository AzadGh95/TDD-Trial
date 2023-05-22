<?php

namespace Tests\Feature\View;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LayoutViewTest extends TestCase
{
    /**
     * A basic feature test example.
      */
    public function test_layout_view_rendered_when_user_is_admin(): void
    {
        $user=User::factory()->state(['type'=>'admin'])->create();
        $this->actingAs($user);
        $view= $this->view('layouts.layout');
        $view->assertSee('<a href="/admin/dashboard">admin panel</a>',false);
    }

    public function test_layout_view_rendered_when_user_is_not_admin(){
        $user=User::factory()->state(['type'=>'user'])->create();
        $this->actingAs($user);

        $view = $this->view('layouts.layout');
        $view->assertDontSee('<a href="/admin/dashboard">admin panel</a>',false);
    }

}
