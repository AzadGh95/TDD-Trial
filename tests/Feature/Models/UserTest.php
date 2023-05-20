<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_insert_data(): void
    {
        User::factory()->create();

        $this->assertDatabaseCount('users', 1);
    }

    // public function test_insert_data_2(): void
    // {
    //     $data = User::factory()->make()->toArray();
    //     $data['password'] = 123456;
    //     User::create($data);
    //     $this->assertDatabaseHas('users', $data);
    // }
}
