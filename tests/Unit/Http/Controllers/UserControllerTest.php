<?php

namespace Tests\Unit\Http\Controller;

use App\Http\Controllers\UserController;
use App\Http\Requests\AddCourseRequest;
use App\Http\Requests\ResetPassRequest;
use App\Http\Requests\UserStoreRequest;
use App\Repositories\User\UserRepositoryInterface;
use Mockery;
use Tests\TestCase;
use Illuminate\Http\RedirectResponse;
use Tests\ControllerTestCase;

class UserControllerTest extends ControllerTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    protected $userController;
    protected $userRepo;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepo = Mockery::mock($this->app->make(UserRepositoryInterface::class));
        $this->userController = new userController($this->userRepo);
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->userController);
        parent::tearDown();
    }

    public function testViewLogin()
    {
        $view = $this->userController->login();
        $this->testAssertView('login.login', $view);
    }

    public function testLoginSuccess()
    {
        $request = new UserStoreRequest([
            'email' => 'student@gmail.com',
            'password' => '123456',
        ]);

        $this->userRepo->shouldReceive('loginUser')->andReturn(true);
        $redirect = $this->userController->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }

    public function testLoginFail()
    {
        $request = new UserStoreRequest([
            'email' => 'student@gmail.com',
            'password' => '123456',
        ]);

        $this->userRepo->shouldReceive('loginUser')->andReturn(false);
        $view = $this->userController->store($request);
        $this->testAssertView('login.login', $view);
    }

    public function testViewLogout()
    {
        $this->userRepo->shouldReceive('logoutUser');

        $redirect = $this->userController->logout();
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }

    public function testViewAdminHome()
    {
        $this->userRepo->shouldReceive('roleUser')->andReturn(config('auth.roles.admin'));
        $view = $this->userController->home();
        $this->testAssertView('admin.home', $view);
    }

    public function testViewLecturerHome()
    {
        $this->userRepo->shouldReceive('roleUser')->andReturn(config('auth.roles.lecturer'));
        $view = $this->userController->home();
        $this->testAssertView('lecturer.home', $view);
    }

    public function testViewStudentHome()
    {
        $this->userRepo->shouldReceive('roleUser')->andReturn(config('auth.roles.student'));
        $view = $this->userController->home();
        $this->testAssertView('student.home', $view);
    }

    public function testViewForgot()
    {
        $view = $this->userController->forgot();
        $this->testAssertView('login.forgot', $view);
    }

    public function testViewResetPass()
    {
        $view = $this->userController->resetpass();
        $this->testAssertView('login.resetpass', $view);
    }

    public function testCorrectOldPass()
    {
        $request = new ResetPassRequest([
            'oldpass' => '123456',
            'newpass' => '123456',
            'confirm' => '12345678',
        ]);
        $this->testReceiveManyActionReturnValue($this->userRepo, [
            'checkOldAndCurrentPass',
        ], [
            false,
        ]);
        $this->userRepo->shouldReceive('checkOldAndCurrentPass')->andReturn(false);
        $redirect = $this->userController->storeResetPass($request);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }

    public function testSameOldAndNewPass()
    {
        $request = new ResetPassRequest([
            'oldpass' => '123456',
            'newpass' => '123456',
            'confirm' => '12345678',
        ]);
        $this->testReceiveManyActionReturnValue($this->userRepo, [
            'checkOldAndCurrentPass',
            'checkSamePassOldAndNew',
        ], [
            true,
            true,
        ]);
    
        $redirect = $this->userController->storeResetPass($request);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }

    public function testSameNewAndConfirmPass()
    {
        $request = new ResetPassRequest([
            'oldpass' => '123456',
            'newpass' => '123456',
            'confirm' => '12345678',
        ]);
        $this->testReceiveManyActionReturnValue($this->userRepo, [
            'checkOldAndCurrentPass',
            'checkSamePassOldAndNew',
            'checkSamePassNewAndConfirm',
            'changePasstobcrypt',
            'updatePass',
        ], [
            true,
            false,
            true,
            true,
            true
        ]);
        
        $redirect = $this->userController->storeResetPass($request);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }

    public function testSameNewAndConfirmPassFail()
    {
        $request = new ResetPassRequest([
            'oldpass' => '123456',
            'newpass' => '123456',
            'confirm' => '12345678',
        ]);
        $this->testReceiveManyActionReturnValue($this->userRepo, [
            'checkOldAndCurrentPass',
            'checkSamePassOldAndNew',
            'checkSamePassNewAndConfirm',
        ], [
            true,
            false,
            false,
        ]);
        
        $redirect = $this->userController->storeResetPass($request);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }
}
