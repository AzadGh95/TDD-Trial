<?php

namespace Tests\Feature\Middlewares;

use App\Http\Middleware\UserActivity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class UserActivityMiddlewareTest extends TestCase
{
    /**
     * @return void
     */
    public function testCanSetUserActivityInCacheWhenUserLoggedIn()
    {
        $user = User::factory()->user()->create();

        $this->actingAs($user);

        $request = Request::create('/', 'GET');

        $middleware = new UserActivity();

        $response = $middleware->handle($request, function () {
        });

        $this->assertNull($response);
        $this->assertEquals('online', Cache::get("user-{$user->id}-status"));
        $this->travel(11)->seconds();
        $this->assertNull(Cache::get("user-{$user->id}-status"));
    }

    /**
     * @return void
     */
    public function testCanSetUserActivityInCacheWhenUserNotLoggedIn()
    {
        $request = Request::create('/', 'GET');

        $middleware = new UserActivity();

        $response = $middleware->handle($request, function () {
        });

        $this->assertNull($response);
    }

    public function testUserActivityMiddlewareSetInWebMiddlewareGroup()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->get(route('home'))
            ->assertOk();

        $this->assertEquals('online', Cache::get("user-{$user->id}-status"));
        $this->assertEquals(\request()->route()->middleware(), ['web']);
    }
}
