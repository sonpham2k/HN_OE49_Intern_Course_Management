<?php

namespace Tests\Unit\Http\Controller;

use App\Http\Controllers\StudentHomeController;
use App\Models\Post;
use Mockery;
use Tests\TestCase;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Semester\SemesterRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Notify\NotifyRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Mockery\Mock;
use Tests\ControllerTestCase;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;

class StudentHomeControllerTest extends ControllerTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    protected $studentHomeController;
    protected $courseRepo;
    protected $userRepo;
    protected $postRepo;
    protected $notiRepo;

    public function setUp(): void
    {
        parent::setUp();

        $this->postRepo = Mockery::mock($this->app->make(PostRepositoryInterface::class));
        $this->courseRepo = Mockery::mock($this->app->make(CourseRepositoryInterface::class));
        $this->semesterRepo = Mockery::mock($this->app->make(SemesterRepositoryInterface::class));
        $this->userRepo = Mockery::mock($this->app->make(UserRepositoryInterface::class));
        $this->notiRepo = Mockery::mock($this->app->make(NotifyRepositoryInterface::class));
        $this->studentHomeController = new StudentHomeController(
            $this->userRepo,
            $this->courseRepo,
            $this->semesterRepo,
            $this->postRepo,
            $this->notiRepo
        );
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->studentHomeController);
        parent::tearDown();
    }

    public function testMarkAsRead()
    {
        $noti = Mockery::mock(DatabaseNotification::class)->makePartial();
        $noti->id = 1;
        $noti->read_at = "2022-04-14 21:20:14";
        $noti->data = [
            'data' => [
                'post_id' => 1,
            ]
        ];
        $this->notiRepo->shouldReceive('getNotify')->andReturn($noti);
        $post = Mockery::mock(Post::class)->makePartial();
        $this->postRepo->shouldReceive('find')->andReturn($post);
        $view = $this->studentHomeController->markAsRead($noti->id);
        $this->testAssertView('student.notice', $view, [
            'post',
        ]);
    }

    public function testMarkAsReadNotRead()
    {
        $noti = Mockery::mock(DatabaseNotification::class)->makePartial();
        $noti->id = 1;
        $noti->data = [
            'data' => [
                'post_id' => 1,
            ]
        ];
        $this->notiRepo->shouldReceive('getNotify')->andReturn($noti);
        $noti->shouldReceive('markAsRead');
        $post = Mockery::mock(Post::class)->makePartial();
        $this->postRepo->shouldReceive('find')->andReturn($post);
        $view = $this->studentHomeController->markAsRead($noti->id);
        $this->testAssertView('student.notice', $view, [
            'post',
        ]);
    }

    public function testMarkAsReadAllFoundList()
    {
        $userUnreadNoti = Mockery::mock(DatabaseNotificationCollection::class)->makePartial();
        $this->notiRepo->shouldReceive('getListUnRead')->andReturn($userUnreadNoti);
        $redirect = $this->studentHomeController->markAsReadAll();
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }

    public function testMarkAsReadAllNotFoundList()
    {
        $this->notiRepo->shouldReceive('getListUnRead')->andReturn(null);
        $redirect = $this->studentHomeController->markAsReadAll();
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }
}
