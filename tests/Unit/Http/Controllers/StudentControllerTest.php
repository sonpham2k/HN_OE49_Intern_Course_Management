<?php

namespace Tests\Unit\Http\Controller;

use App\Http\Controllers\StudentController;
use Mockery;
use Tests\TestCase;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\AddUserRequest;

class StudentControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    protected $studentController;
    protected $userRepo;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepo = Mockery::mock($this->app->make(UserRepositoryInterface::class));
        $this->studentController = new StudentController($this->userRepo);
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->studentController);
        parent::tearDown();
    }

    public function testIndex()
    {
        $this->userRepo->shouldReceive('getStudent');
        $view = $this->studentController->index();

        $this->assertEquals('admin.student.list', $view->getName());
        $this->assertArrayHasKey('students', $view->getData());

    }

    public function testCreate()
    {
        $view = $this->studentController->create();

        $this->assertEquals('admin.student.add', $view->getName());
    }

    public function testShow()
    {
        $this->userRepo->shouldReceive('getTeacher')->with(1);
        $view = $this->studentController->show(1);

        $this->assertEquals('admin.student.show', $view->getName());
        $this->assertArrayHasKey('user', $view->getData());
    }

    public function testEdit()
    {
        $this->userRepo->shouldReceive('editStudent')->with(1);
        $view = $this->studentController->edit(1);

        $this->assertEquals('admin.student.edit', $view->getName());
        $this->assertArrayHasKey('student', $view->getData());
    }

    public function testStore()
    {
        $request = new AddUserRequest([
            'username' => 'student123',
            'password' => '12345678',
            'fullname' => 'Pham Ngoc Son',
            'dob' => '10/10/2000',
            'email' => 'student123@gmail.com',
            'address' => 'Hung Yen',
            'role_id' => config('auth.roles.student'),
        ]);
        $this->userRepo->shouldReceive('insertStudent')->andReturn(true);

        $response = $this->studentController->store($request);
        $view = $this->studentController->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testUpdate()
    {
        $request = new EditUserRequest([
            'fullname' => 'Pham Ngoc Son',
            'username' => 'Student123',
            'dob' => '10/10/2000',
            'address' => 'Hung Yen',
            'email' => 'Student123@gmail.com',
        ]);
        $this->userRepo->shouldReceive('updateStudent')->andReturn(true);

        $response = $this->studentController->update($request, 1);
        $view = $this->studentController->update($request, 1);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testDestroySuccess()
    {
        $this->userRepo->shouldReceive('delete')->andReturn(true);
        $response = $this->studentController->destroy(1);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }
}
