<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;

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

    public function userCheck()
    {
        $user = User::find(auth()->user());
        
        return $user;
    }

    public function changePasstobcrypt($attributes = [])
    {
        return bcrypt($attributes['newpass']);
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
