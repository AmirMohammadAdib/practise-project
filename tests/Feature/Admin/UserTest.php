<?php

namespace Tests\Feature\Admin;

use App\Models\Post;
use App\Models\User;
use App\Repository\Elequents\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_show_all_users_with_permission(): void
    {
        $users = User::all();
        $response = $this->actingAs(User::factory()->create()->givePermissionTo(User::VIEW_ANY_PERMISSION))->get(route("user.index"));

        $response->assertOk();
    }

    public function test_show_all_users_without_permission(): void
    {
        $users = User::all();
        $response = $this->actingAs(User::factory()->create())->get(route("user.index"));

        $response->assertStatus(403);
    }

    public function test_show_all_users_not_logged_in_by_the_user(): void
    {
        $users = User::all();
        $response = $this->get(route("user.index"));

        $response->assertRedirect();
    }

    public function test_hiding_the_create_user_button_if_you_dont_have_permission()
    {
        $response = $this->actingAs(User::factory()->create()->givePermissionTo(User::VIEW_ANY_PERMISSION))->get(route("user.index"));
        $response->assertOk()->assertDontSee("create user");
    }

    public function test_hiding_the_create_user_button_if_you_have_permission()
    {
        $response = $this->actingAs(User::factory()->create()->givePermissionTo([User::VIEW_ANY_PERMISSION, User::CREATE_PERMISSION]))->get(route("user.index"));
        $response->assertOk()->assertSee("create user");
    }

    public function test_hiding_the_edit_user_button_if_you_dont_have_permission()
    {
        $response = $this->actingAs(User::factory()->create()->givePermissionTo(User::VIEW_ANY_PERMISSION))->get(route("user.index"));
        $response->assertOk()->assertDontSee("edit");
    }

    public function test_hiding_the_edit_user_button_if_you_have_permission()
    {
        $response = $this->actingAs(User::factory()->create()->givePermissionTo([User::VIEW_ANY_PERMISSION, User::UPDATE_PERMISSION]))->get(route("user.index"));
        $response->assertOk()->assertSee("edit");
    }


    public function test_hiding_the_delete_user_button_if_you_dont_have_permission()
    {
        $response = $this->actingAs(User::factory()->create()->givePermissionTo(User::VIEW_ANY_PERMISSION))->get(route("user.index"));
        $response->assertOk()->assertDontSee("delete");
    }

    public function test_hiding_the_delete_user_button_if_you_have_permission()
    {
        $response = $this->actingAs(User::factory()->create()->givePermissionTo([User::VIEW_ANY_PERMISSION, User::DESTROY_PERMISSION]))->get(route("user.index"));
        $response->assertOk()->assertSee("delete");
    }


    public function test_show_create_user_page_with_permission()
    {
        $response = $this->actingAs(User::factory()->create()->givePermissionTo(User::CREATE_PERMISSION))->get(route("user.create"));
        $response->assertOk();
    }

    public function test_show_create_user_page_without_permission()
    {
        $response = $this->actingAs(User::factory()->create())->get(route("user.create"));
        $response->assertStatus(403);
    }

    public function test_show_create_user_page_not_logged_in_by_the_user()
    {
        $response = $this->get(route("user.create"));
        $response->assertRedirect();
    }
    public function test_create_user_successfuly_with_permission()
    {
        $data = User::factory()->make()->toArray();
        $data['password'] = 31013101;
        $response = $this->actingAs(User::factory()->create()->givePermissionTo(User::CREATE_PERMISSION))->post(route("user.store"), $data);
        $response->assertRedirect();
        $this->assertDatabaseHas("users", ["email" => $data['email']]);
    }

    public function test_create_user_successfuly_without_permission()
    {
        $data = User::factory()->make()->toArray();
        $data['password'] = 31013101;
        $response = $this->actingAs(User::factory()->create())->post(route("user.store"), $data);
        $response->assertStatus(403);
        $this->assertDatabaseMissing("users", ["email" => $data['email']]);
    }

    public function test_user_create_form_validation()
    {
        $data = [
            "email" => "dsaaxadew",
            "name" => "",
            "password" => 12,
        ];

        $response = $this->actingAs(User::factory()->create()->givePermissionTo(User::CREATE_PERMISSION))->post(route("user.store"), $data);
        $response->assertRedirect();
        $this->assertDatabaseMissing("users", ["email" => $data['email']]);
    }

    public function test_show_edit_user_page_with_permission()
    {
        $new_user = User::factory()->create();
        $response = $this->actingAs(User::factory()->create()->givePermissionTo(User::UPDATE_PERMISSION))->get(route("user.edit", [$new_user->id]));
        $response->assertOk();
    }

    public function test_show_edit_user_page_without_permission()
    {
        $new_user = User::factory()->create();
        $response = $this->actingAs(User::factory()->create())->get(route("user.edit", [$new_user->id]));
        $response->assertStatus(403);
    }

    public function test_show_edit_user_page_not_logged_in_by_the_user()
    {
        $new_user = User::factory()->create();
        $response = $this->get(route("user.edit", [$new_user->id]));
        $response->assertRedirect();
    }

    public function test_edit_user_successfuly_with_permission()
    {
        $data = User::factory()->create();
        $new_information = User::factory()->make()->toArray();
        $new_information['_method'] = "PUT";
        $response = $this->actingAs(User::factory()->create()->givePermissionTo(User::UPDATE_PERMISSION))->post(route("user.update", [$data]), $new_information);
        $response->assertRedirect();
        $this->assertEquals(User::find($data->id)->email, $new_information['email']);
    }

    public function test_edit_user_successfuly_without_permission()
    {
        $data = User::factory()->create();
        $new_information = User::factory()->make()->toArray();
        $new_information['_method'] = "PUT";
        $response = $this->actingAs(User::factory()->create())->post(route("user.update", [$data]), $new_information);
        $response->assertStatus(403);
        $this->assertNotEquals(User::find($data->id)->email, $new_information['email']);
    }

    public function test_user_edit_form_validation()
    {
        $data = User::factory()->create();
        $new_information = [
            "name" => "",
            "email" => "fdsacfsew",
            "_method" => "PUT",
        ];
        $response = $this->post(route("user.update", [$data]), $new_information);
        $response->assertRedirect();
        $this->assertNotEquals(User::find($data->id)->email, $new_information['email']);
    }

    //delete
    public function test_can_delete_user_with_permission()
    {
        $user = User::factory()->create();
        $response = $this->actingAs(User::factory()->create()->givePermissionTo(User::DESTROY_PERMISSION))->post(route("user.destroy", [$user, "_method" => "DELETE"]));
        $response->assertRedirect();
        $this->assertDatabaseMissing("users", ["id" => User::find($user->id)]);
    }

    public function test_can_delete_user_without_permission()
    {
        $user = User::factory()->create();
        $response = $this->actingAs(User::factory()->create())->post(route("user.destroy", [$user, "_method" => "DELETE"]));
        $response->assertStatus(403);
        $this->assertDatabaseHas("users", ["id" => $user->id]);
    }

    public function test_can_delete_user_not_logged_in_by_the_user()
    {
        $user = User::factory()->create();
        $response = $this->post(route("user.destroy", [$user, "_method" => "DELETE"]));
        $response->assertRedirect();
        $this->assertDatabaseHas("users", ["id" => $user->id]);
    }

}