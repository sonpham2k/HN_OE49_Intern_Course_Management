<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('Login.login');
    }

    public function forgot()
    {
        return view('Login.forgot');
    }

    public function resetpass()
    {
        return view('Login.resetpass');
    }
}
