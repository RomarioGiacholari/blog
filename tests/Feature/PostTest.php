<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_authenticated_user_can_create_a_post()
    {
        $email = config('app.admin_email');
        $user  = User::factory()->create(['email' => $email]);

        $this->actingAs($user);

        $data = [
            'title' => 'some title',
            'body'  => 'some body',
        ];

        $endpoint = route('posts.store');

        $response = $this->post($endpoint, $data);

        $post = Post::query()->first();

        $response->assertRedirect($post->path());
    }

    public function test_an_authenticated_user_can_delete_a_post()
    {
        $email = config('app.admin_email');
        $user  = User::factory()->create(['email' => $email]);

        $this->actingAs($user);

        $data = $data = Post::factory()->make();

        $post = $user->posts()->save($data);

        $endpoint = route('posts.destroy', $post);

        $response = $this->delete($endpoint);

        $response->assertStatus(302);
        $response->assertRedirect(route('home.posts'));
    }

    public function test_an_authenticated_user_can_update_a_post()
    {
        $email = config('app.admin_email');
        $user  = User::factory()->create(['email' => $email]);

        $this->actingAs($user);

        $data = Post::factory()->make();

        $updateData = [
            'title' => 'changed title',
            'body'  => 'changed body',
        ];

        $post = $user->posts()->save($data);

        $endpoint =  route('posts.update', $post);

        $response = $this->patch($endpoint, $updateData);

        $response->assertStatus(302);
        $response->assertRedirect(route('home.posts'));
    }

    public function test_an_unauthenticated_user_cannot_create_a_post()
    {
        $user  = User::factory()->create();

        $this->actingAs($user);

        $data = [
            'title' => 'some title',
            'body'  => 'some body',
        ];

        $endpoint = route('posts.store');

        $response = $this->post($endpoint, $data);

        $response->assertRedirect(route('welcome'));
    }

    public function test_the_body_and_title_attributes_are_required()
    {
        $email = config('app.admin_email');
        $user  = User::factory()->create(['email' => $email]);

        $this->actingAs($user);

        $data = [
            'title' => null,
            'body'  => null,
        ];

        $endpoint = route('posts.store');

        $response = $this->post($endpoint, $data);

        $response->assertStatus(302);
    }
}
