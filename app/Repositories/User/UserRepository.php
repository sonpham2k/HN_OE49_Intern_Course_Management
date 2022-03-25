<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getLecturer()
    {
        return User::where('role_id', config('auth.roles.lecturer'))->get();
    }

    public function loginUser($attributes = [])
    {
        $login = Auth::attempt([
            'email' => $attributes['email'],
            'password' => $attributes['password'],
        ]);

        return $login;
    }

    public function logoutUser()
    {
        return Auth::logout();
    }

    public function roleUser()
    {
        $role = Auth::user()->role_id;

        return $role;
    }

    public function checkOldAndCurrentPass($attributes = [])
    {
        $input = $attributes['oldpass'];
        $user = User::find(auth()->user()->id);
        
        return Hash::check($input, $user->password);
    }

    public function changePasstobcrypt($attributes = [])
    {
        return bcrypt($attributes['newpass']);
    }

    public function updatePass($newpass)
    {
        Auth::user()->update(['password' => $newpass]);
    }

    public function checkSamePassOldAndNew($attributes = [])
    {
        $newpass = $attributes['newpass'];
        $oldpass = $attributes['oldpass'];
        if ($newpass == $oldpass) {
            return true;
        }

        return false;
    }

    public function checkSamePassNewAndConfirm($attributes = [])
    {
        $newpass = $attributes['newpass'];
        $confirmpass = $attributes['confirmpass'];
        if ($newpass == $confirmpass) {
            return true;
        }

        return false;
    }
}
