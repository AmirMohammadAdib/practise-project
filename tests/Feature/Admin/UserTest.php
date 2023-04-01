<?php

namespace Tests\Feature\Admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_cerate_a_user_with_permission(): void
    {
        $this->actingAs(User::factory()->make()->givePermissionTo(User::CREATE_PERMISSION));
        $data = User::factory()->make()->toArray();
        $data['password'] = Hash::make(31013101);
        unset($data['email_verified_at']);

        $response = $this->post(route("user.store"), $data);
                
        $response->assertRedirect();
        $this->assertDatabaseHas("users", ["email" => $data["email"]]);
    }
}
