<?php

namespace Tests\Unit\Http\Controller;

use App\Http\Controllers\LecturerHomeController;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Semester\SemesterRepositoryInterface;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Semester;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;
use Illuminate\Http\RedirectResponse;
use Tests\ControllerTestCase;
use Illuminate\Support\Facades\Auth;

class LecturerHomeControllerTest extends ControllerTestCase
{
    protected $lecturerHomeController;
    protected $userRepo;
    protected $courseRepo;
    protected $semesterRepo;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepo = Mockery::mock($this->app->make(UserRepositoryInterface::class));
        $this->courseRepo = Mockery::mock($this->app->make(CourseRepositoryInterface::class));
        $this->semesterRepo = Mockery::mock($this->app->make(SemesterRepositoryInterface::class));
        $this->lecturerHomeController = new lecturerHomeController(
            $this->userRepo,
            $this->courseRepo,
            $this->semesterRepo
        );
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->lecturerHomeController);
        parent::tearDown();
    }

    public function testViewHome()
    {
        $view = $this->lecturerHomeController->home();
        $this->testAssertView('lecturer.home', $view);
    }

    public function testGetTimeTable()
    {
        $this->semesterRepo->shouldReceive('getAll');
        $this->userRepo->shouldReceive('getTimeTableUser');

        $view = $this->lecturerHomeController->getTimeTable();
        $this->testAssertView('lecturer.timetable', $view);
    }

    public function testListStudent()
    {
        $course = Mockery::mock(Course::class)->makePartial();
        $course->course_id = 1;
        $this->userRepo->shouldReceive('getListStudent')->andReturn($course);

        $view = $this->lecturerHomeController->listStudent($course->course_id);
        $this->testAssertView('lecturer.liststudent', $view);
    }

    public function testShow()
    {
        $id = 1;
        $redirect = $this->lecturerHomeController->show($id);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }

    public function testEditTrue()
    {
        $user = Mockery::mock(User::class)->makePartial();
        Auth::shouldReceive('user')->andReturn(true);

        $view = $this->lecturerHomeController->edit();
        $this->testAssertView('lecturer.edit', $view);
    }

    public function testEditFail()
    {
        Auth::shouldReceive('user')->andReturn();

        $this->expectExceptionMessage('Not Found');
        $view = $this->lecturerHomeController->edit();
        $this->testAssertView('lecturer.edit', $view);
    }

    public function testUpdate()
    {
        $request = new UpdateProfileRequest([
            'fullname' => 'Jack',
            'dob' => '01/01/2020',
            'address' => 'HCM',
        ]);

        $this->userRepo->shouldReceive('updateUser');
        $redirect = $this->lecturerHomeController->update($request);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }

    public function testViewChart()
    {
        $request = new Request();
        $request->watch = 5;
        $this->userRepo->shouldReceive('searchAllLecturer');
        $this->userRepo->shouldReceive('searchLecturer');
        $this->userRepo->shouldReceive('getDataChart')->andReturn(collect(['2021-2022' => 100]));

        $view = $this->lecturerHomeController->viewChart($request);
        $this->testAssertView('charts.chart', $view);
    }
}
