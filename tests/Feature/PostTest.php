<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * @coversNothing
 */
class PostTest extends TestCase
{
    use DatabaseTransactions;

    public function test_an_authenticated_user_can_create_a_post()
    {
        $email = config('app.admin_email');
        $user  = factory(User::class)->create(['email' => $email]);

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

    public function test_an_authenticated_user_can_delte_a_post()
    {
        $email = config('app.admin_email');
        $user  = factory(User::class)->create(['email' => $email]);

        $this->actingAs($user);

        $data = $data = factory(Post::class)->make();

        $post = $user->posts()->save($data);

        $endpoint = route('posts.destroy', $post);

        $response = $this->delete($endpoint);

        $response->assertStatus(302);
        $response->assertRedirect(route('home.posts'));
    }

    public function test_an_authenticated_user_can_update_a_post()
    {
        $email = config('app.admin_email');
        $user  = factory(User::class)->create(['email' => $email]);

        $this->actingAs($user);

        $data = factory(Post::class)->make();

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

    public function test_an_anuthenticated_user_cannot_create_a_post()
    {
        $user  = factory(User::class)->create();

        $this->actingAs($user);

        $data = [
            'title' => 'some title',
            'body'  => 'some body',
        ];

        $endpoint = route('posts.store');

        $response = $this->post($endpoint, $data);

        $response->assertRedirect(route('welcome'));
    }

    public function test_the_body_and_title_attrubutes_are_required()
    {
        $email = config('app.admin_email');
        $user  = factory(User::class)->create(['email' => $email]);

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
