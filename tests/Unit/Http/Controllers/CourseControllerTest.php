<?php

namespace Tests\Unit\Http\Controller;

use App\Http\Controllers\CourseController;
use App\Http\Requests\AddCourseRequest;
use App\Http\Requests\EditCourseRequest;
use App\Models\Course;
use App\Models\User;
use Mockery;
use Tests\TestCase;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Semester\SemesterRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Tests\ControllerTestCase;

class CourseControllerTest extends ControllerTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    protected $courseController;
    protected $courseRepo;
    protected $semesterRepo;
    protected $userRepo;

    public function setUp(): void
    {
        parent::setUp();
        $this->courseRepo = Mockery::mock($this->app->make(CourseRepositoryInterface::class));
        $this->semesterRepo = Mockery::mock($this->app->make(SemesterRepositoryInterface::class));
        $this->userRepo = Mockery::mock($this->app->make(UserRepositoryInterface::class));
        $this->courseController = new CourseController($this->courseRepo, $this->semesterRepo, $this->userRepo);
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->courseController);
        parent::tearDown();
    }

    public function testIndexReturnView()
    {
        $this->courseRepo->shouldReceive('getAllCourseWithLecturer');
        $view = $this->courseController->index();
        $this->testAssertView('admin.course.list', $view, ['courses']);
    }

    public function testCreateReturnView()
    {
        $this->testReceiveManyRepo([$this->userRepo, $this->semesterRepo], ['getLecturer', 'getAll']);
        $view = $this->courseController->create();
        $this->testAssertView('admin.course.add', $view, ['users', 'semesters']);
    }

    public function testDestroy()
    {
        $this->courseRepo->shouldReceive('delete')->andReturn(true);
        $response = $this->courseController->destroy(1);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testUpdateNotFoundUser()
    {
        $request = new EditCourseRequest([
            'name' => 'Hoá 10',
            'user' => 2,
            'credits' => 3,
            'numbers' => 70,
            'semester_id' => 2,
        ]);
        $course = Mockery::mock(Course::class)->makePartial();
        $course->id = 1;
        $user = Mockery::mock(User::class)->makePartial();
        $user->id = 1;
        $course->setRelation('users', $user);
        $this->userRepo->shouldReceive('find')->andReturn($user);
        $this->testReceiveManyActionReturnValue($this->courseRepo, [
            'update',
            'getCourseWithLecturer'
        ], [
            true,
            $course,
        ]);
        $course->shouldReceive('users->attach')->andReturn(true);
        $redirect = $this->courseController->update($request, $course->id);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }

    public function testUpdateFoundUser()
    {
        $request = new EditCourseRequest([
            'name' => 'Hoá 10',
            'user' => 2,
            'credits' => 3,
            'numbers' => 70,
            'semester_id' => 2,
        ]);
        $course = Mockery::mock(Course::class)->makePartial();
        $course->id = 1;
        $user = Mockery::mock(User::class)->makePartial();
        $user->id = 1;

        $course->setRelation('users', [$user]);
        $this->userRepo->shouldReceive('find')->andReturn($user);
        $this->testReceiveManyActionReturnValue($this->courseRepo, [
            'update',
            'getCourseWithLecturer'
        ], [
            true,
            $course,
        ]);
        $this->testReceiveManyAction($course, [
            'users->detach',
            'users->attach',
        ]);
        $redirect = $this->courseController->update($request, $course->id);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }

    public function testUpdateFoundUser1()
    {
        $request = new EditCourseRequest([
            'name' => 'Hoá 10',
            'user' => 1,
            'credits' => 3,
            'numbers' => 70,
            'semester_id' => 2,
        ]);
        $course = Mockery::mock(Course::class)->makePartial();
        $course->id = 1;
        $user = Mockery::mock(User::class)->makePartial();
        $user->id = 1;

        $course->setRelation('users', [$user]);
        $this->userRepo->shouldReceive('find')->andReturn($user);
        $this->testReceiveManyActionReturnValue($this->courseRepo, [
            'update',
            'getCourseWithLecturer'
        ], [
            true,
            $course,
        ]);
        $redirect = $this->courseController->update($request, $course->id);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }

    public function testEdit()
    {
        $this->testReceiveManyRepo([
            $this->courseRepo,
            $this->userRepo,
            $this->semesterRepo,
        ], [
            'getCourseWithLecturer',
            'getLecturer',
            'getAll'
        ]);
        $view = $this->courseController->edit(1);
        $this->testAssertView('admin.course.edit', $view, [
            'course',
            'semesters',
            'lecturers',
        ]);
    }

    public function testShow()
    {
        $this->testReceiveManyAction($this->courseRepo, [
            'find',
            'getStudentOfCourse',
        ]);
        $view = $this->courseController->show(1);
        $this->testAssertView('admin.course.show', $view, [
            'course',
            'users',
        ]);
    }

    public function testStore()
    {
        $this->testReceiveManyRepo([
            $this->userRepo,
            $this->semesterRepo,
        ], [
            'find',
            'find',
        ]);
        $count = 1;
        $this->courseRepo->shouldReceive('create')->andReturn($count);
        $request = new AddCourseRequest([
            'name' => 'Sinh học',
            'user' => 5,
            'credits' => 3,
            'numbers' => 70,
            'semester_id' => 2,
        ]);
        $response = $this->courseController->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }
}
