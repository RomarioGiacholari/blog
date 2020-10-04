<?php

namespace Tests\Unit;

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

    public function test_a_user_has_many_posts()
    {
        $user          = factory(User::class)->create();
        $inMemoryPosts = factory(Post::class, 2)->make();

        $posts = $user->posts()->saveMany($inMemoryPosts);

        $this->assertTrue($user->posts->contains($posts[0]));
        $this->assertTrue($user->posts->contains($posts[1]));
    }

    public function test_a_post_belongs_to_a_user()
    {
        $user          = factory(User::class)->create();
        $inMemoryPost  = factory(Post::class)->make();

        $post = $user->posts()->save($inMemoryPost);

        $this->assertSame($post->creator->id, $user->id);
    }
}
