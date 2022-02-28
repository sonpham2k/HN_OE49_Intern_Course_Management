<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function store(UserStoreRequest $request)
    {
        if (Auth::attempt([
            'username' => $request->username(),
            'password' => $request->password(),
        ])) {
            $role = Auth::user()->role_id;
            $request->session()->put('role', $role);

            return redirect()->route('home');
        }
        $data = "__('Login fail')";

        return view('login', compact('data'));
    }

    public function logout()
    {
        Auth::logout();

        return view('login');
    }

    public function home()
    {
        $role = session('role');
        if ($role == config('auth.roles.admin')) {
            return view('admin.home');
        } elseif ($role == config('auth.roles.lecturer')) {
            return view('lecturer.home');
        } else {
            return view('student.home');
        }
    }
}
