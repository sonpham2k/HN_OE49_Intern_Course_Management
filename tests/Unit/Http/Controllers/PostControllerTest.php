<?php

namespace Tests\Unit\Http\Controller;

use App\Http\Controllers\PostController;
use App\Models\Post;
use Mockery;
use App\Repositories\Post\PostRepositoryInterface;
use Tests\ControllerTestCase;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\NewPost;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\RedirectResponse;

class PostControllerTest extends ControllerTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    protected $postController;
    protected $postRepo;

    public function setUp(): void
    {
        parent::setUp();
        $this->postRepo = Mockery::mock($this->app->make(PostRepositoryInterface::class));
        $this->postController = new PostController($this->postRepo);
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->postController);
        parent::tearDown();
    }

    public function testCreatePost()
    {
        $view = $this->postController->create();
        $this->testAssertView('admin.post.add', $view);
    }

    public function testStorePost()
    {
        $request = new Request([
            'title' => 'thông báo',
            'content' => 'test thử',
        ]);
        $post = Mockery::mock(Post::class)->makePartial();
        $this->postRepo->shouldReceive('create')->andReturn($post);
        $user = Mockery::mock(User::class)->makePartial();
        $follower = Mockery::mock(User::class)->makePartial();
        Auth::shouldReceive('user')->andReturn($user);
        $user->setRelation('followers', [$follower]);
        $newpost = Mockery::mock(NewPost::class)->makePartial();
        $newpost->shouldReceive('new');
        Notification::shouldReceive('send');

        $redirect = $this->postController->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }
}
