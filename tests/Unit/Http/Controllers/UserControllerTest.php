<?php

namespace Tests\Unit\Http\Controller;

use App\Http\Controllers\UserController;
use App\Http\Requests\AddCourseRequest;
use App\Http\Requests\ResetPassRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\ForgotPassRequest;
use App\Http\Requests\ResetPassForgotRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepositoryInterface;
use Mockery;
use Tests\TestCase;
use Illuminate\Http\RedirectResponse;
use Tests\ControllerTestCase;
use App\Models\User;

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

        Auth::shouldReceive('attempt')->andReturn(true);
        $redirect = $this->userController->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }

    public function testLoginFail()
    {
        $request = new UserStoreRequest([
            'email' => 'student@gmail.com',
            'password' => '123456',
        ]);

        Auth::shouldReceive('attempt')->andReturn(false);
        $view = $this->userController->store($request);
        $this->testAssertView('login.login', $view);
    }

    public function testViewLogout()
    {
        Auth::shouldReceive('logout');

        $redirect = $this->userController->logout();
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }

    public function testViewAdminHome()
    {
        $user = Mockery::mock(User::class)->makePartial();
        $user->role_id = config('auth.roles.admin');
        Auth::shouldReceive('user')->andReturn($user);

        $view = $this->userController->home();
        $this->testAssertView('admin.home', $view);
    }

    public function testViewLecturerHome()
    {
        $user = Mockery::mock(User::class)->makePartial();
        $user->role_id = config('auth.roles.lecturer');
        Auth::shouldReceive('user')->andReturn($user);

        $view = $this->userController->home();
        $this->testAssertView('lecturer.home', $view);
    }

    public function testViewStudentHome()
    {
        $user = Mockery::mock(User::class)->makePartial();
        $user->role_id = config('auth.roles.student');
        Auth::shouldReceive('user')->andReturn($user);

        $view = $this->userController->home();
        $this->testAssertView('student.home', $view);
    }

    public function testSendEmailSuccess()
    {
        $request = new ForgotPassRequest([
            'email' => 'Jack97@gmail.com'
        ]);
        $user = User::factory()->make();

        $this->userRepo->shouldReceive('findUser')->andReturn($user);
        $this->userRepo->shouldReceive('getCodeResetPass')->andReturn($user);
        
        $redirect = $this->userController->sendEmail($request);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }

    public function testSendEmailFail()
    {
        $request = new ForgotPassRequest([
            'email' => 'phamngocson_t63@hus.edu.com'
        ]);
        $this->userRepo->shouldReceive('findUser')->andReturn(false);
        
        $redirect = $this->userController->sendEmail($request);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
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

        $user = Mockery::mock(User::class)->makePartial();
        $user->id = 1;
        $user->password = '123456';

        Auth::shouldReceive('user')->andReturn($user);
        Hash::shouldReceive('check')->andReturn(false);
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

        $user = Mockery::mock(User::class)->makePartial();
        $user->id = 1;
        $user->password = '123456';
        Auth::shouldReceive('user')->andReturn($user);
        Hash::shouldReceive('check')->andReturn(true);
        
        $this->userRepo->shouldReceive('checkSamePassOldAndNew')->andReturn(true);
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

        $user = Mockery::mock(User::class)->makePartial();
        $user->id = 1;
        $user->password = '123456';
        Auth::shouldReceive('user')->andReturn($user);
        Hash::shouldReceive('check')->andReturn(true);

        $this->testReceiveManyActionReturnValue($this->userRepo, [
            'checkSamePassOldAndNew',
            'checkSamePassNewAndConfirm',
        ], [
            false,
            true,
        ]);

        $newpassword = $this->userRepo->shouldReceive('changePasstobcrypt')->andReturn($request->newpass);
        $user = User::factory()->make();
        Auth::shouldReceive('user->update')->andReturn(true);
        
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
        
        $user = Mockery::mock(User::class)->makePartial();
        $user->id = 1;
        $user->password = '123456';
        Auth::shouldReceive('user')->andReturn($user);
        Hash::shouldReceive('check')->andReturn(true);

        $this->testReceiveManyActionReturnValue($this->userRepo, [
            'checkSamePassOldAndNew',
            'checkSamePassNewAndConfirm',
        ], [
            false,
            false,
        ]);
        
        $redirect = $this->userController->storeResetPass($request);
        $this->assertInstanceOf(RedirectResponse::class, $redirect);
    }
}
