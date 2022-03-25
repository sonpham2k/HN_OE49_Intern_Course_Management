<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\ResetPassRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(
        UserRepositoryInterface $userRepo
    ) {
        $this->userRepo = $userRepo;
    }

    public function login()
    {
        return view('login.login');
    }

    public function store(UserStoreRequest $request)
    {
        $checkLogin = $this->userRepo->loginUser([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        if ($checkLogin) {
            return redirect()->route('home');
        }
        $data = "__('Login fail')";

        return view('login.login', compact('data'));
    }

    public function logout()
    {
        $user = $this->userRepo->logoutUser();

        return redirect()->route('login');
    }

    public function home()
    {
        $role = $this->userRepo->roleUser();

        if ($role == config('auth.roles.admin')) {
            return view('admin.home');
        } elseif ($role == config('auth.roles.lecturer')) {
            return view('lecturer.home');
        } else {
            return view('student.home');
        }
    }

    public function forgot()
    {
        return view('login.forgot');
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

        $checkLogin = $this->userRepo->checkOldAndCurrentPass($input);
        $checkSamePassOldNew = $this->userRepo->checkSamePassOldAndNew($input);
        $checkSamePassNewConfirm = $this->userRepo->checkSamePassNewAndConfirm($input);

        if (!$checkLogin) {
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
                $this->userRepo->updatePass($newpassword);
                
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
