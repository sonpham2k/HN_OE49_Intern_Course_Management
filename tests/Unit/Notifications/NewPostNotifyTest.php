<?php

namespace Tests\Unit\Notifications;

use App\Models\Post;
use App\Models\User;
use App\Notifications\NewPost;
use Mockery;
use Tests\TestCase;

class NewPostNotifyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    protected $postNoti;
    protected $post;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->post = Mockery::mock($this->app->make(Post::class));
        $this->user = Mockery::mock($this->app->make(User::class));
        $this->postNoti = new NewPost($this->user, $this->post);
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->postNoti);
        parent::tearDown();
    }

    public function testVia()
    {
        $via = $this->postNoti->via(User::class);
        $this->assertEquals(['database'], $via);
    }

    public function testToArray()
    {
        $this->markTestSkipped();
    }
}
