<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

/**
 * @coversNothing
 */
class PostTest extends TestCase
{
    use DatabaseTransactions;

    public function test_a_user_has_many_posts()
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Collection $inMemoryPosts */
        $inMemoryPosts = Post::factory()->count(2)->make();

        /** @var Post $posts */
        $posts = $user->posts()->saveMany($inMemoryPosts);

        $this->assertTrue($user->posts->contains($posts[0]));
        $this->assertTrue($user->posts->contains($posts[1]));
    }

    public function test_a_post_belongs_to_a_user()
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Post $inMemoryPost */
        $inMemoryPost = Post::factory()->make();

        $post = $user->posts()->save($inMemoryPost);

        $this->assertSame($post->creator->id, $user->id);
    }
}
