<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\ResetPassRequest;
use App\Http\Requests\ForgotPassRequest;
use App\Http\Requests\ResetPassForgotRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login()
    {
        return view('login.login');
    }

    public function store(UserStoreRequest $request)
    {
        if (Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ])
        ) {
            return redirect()->route('home');
        }
        $data = __('Login fail');

        return view('login.login', compact('data'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function home()
    {
        $role = Auth::user()->role_id;

        if ($role == config('auth.roles.admin')) {
            return view('admin.home');
        } elseif ($role == config('auth.roles.lecturer')) {
            return view('lecturer.home');
        } else {
            return view('student.home');
        }
    }

    public function sendEmail(ForgotPassRequest $request)
    {
        $email = $request->input('email');

        return redirect()->route('send.mail');
    }

    public function viewResetForgotPass()
    {
        return view('login.resetForgotPass');
    }

    public function resetForgotPass(ResetPassForgotRequest $request)
    {
        $email = $request->input('email');
        $newpass = $request->input('newpass');
        $confirmpass = $request->input('confirmpass');
        
        return redirect()->route('reset.forgot.password');
    }

    public function resetpass()
    {
        return view('login.resetpass');
    }

    public function storeResetPass(ResetPassRequest $request)
    {
        $input = [
            'oldpass' => $request->input('oldpass'),
            'newpass' => $request->input('newpass'),
            'confirmpass' => $request->input('confirmpass'),
        ];

        $userCheck = $this->userRepo->userCheck();
        $checkSamePassOldNew = $this->userRepo->checkSamePassOldAndNew($input);
        $checkSamePassNewConfirm = $this->userRepo->checkSamePassNewAndConfirm($input);
        if (!Hash::check($input['oldpass'], $userCheck->password)) {
            return redirect()
                ->route('reset')
                ->with('error', __('error pass'));
        } else {
            if ($checkSamePassOldNew) {
                return redirect()
                    ->route('reset')
                    ->with('error', __('same pass'));
            } elseif ($checkSamePassNewConfirm) {
                $newpassword = $this->userRepo->changePasstobcrypt($input);
                Auth::user()->update(['password' => $newpassword]);
                
                return redirect()
                    ->route('reset')
                    ->with('success', __('sucess pass'));
            } else {
                return redirect()
                    ->route('reset')
                    ->with('error', __('error confirm'));
            }
        }
    }
}
