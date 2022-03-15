<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\ResetPassRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function store(UserStoreRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ])) {
            $request->session()->put('user', Auth::user());

            return redirect()->route('home');
        }
        $data = "__('Login fail')";

        return view('login.login', compact('data'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('user');

        return redirect()->route('login');
    }

    public function home()
    {
        $role = session('user')->role_id;
        $user = session('user');

        if ($role == config('auth.roles.admin')) {
            return view('admin.home', compact('user'));
        } elseif ($role == config('auth.roles.lecturer')) {
            return view('lecturer.home', compact('user'));
        } else {
            return view('student.home', compact('user'));
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
        //
    }
}
