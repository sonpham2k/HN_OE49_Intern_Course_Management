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

    public function getStudents()
    {
        return User::where('role_id', config('auth.roles.student'))->get();
    }

    public function getAllUser()
    {
        return User::all();
    }

    public function insertDB($attributes = [])
    {
        DB::table('users')->insert([
            'username' => $attributes['username'],
            'password' => Hash::make($attributes['password']),
            'fullname' => $attributes['fullname'],
            'dob' => $attributes['dob'],
            'email' => $attributes['email'],
            'address' => $attributes['address'],
            'role_id' => $attributes['role_id'],
        ]);
    }

    public function showCourseOfStudent($id)
    {
        return User::with([
            'courses.users' => function ($query) {
                $query->where('role_id', config('auth.roles.lecturer'));
            },
        ])->findOrFail($id);
    }

    public function updateDB($id, $attributes = [])
    {
        $this->find($id);
        DB::table('users')
            ->where('id', $id)
            ->update([
                'fullname' => $attributes['fullname'],
                'username' => $attributes['username'],
                'dob' => $attributes['dob'],
                'address' => $attributes['address'],
                'email' => $attributes['email'],
            ]);
    }

    public function delete($id)
    {
        $user = $this->find($id);
        $user->courses()->detach();
        $user->delete();
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

    public function getTimeTableUser()
    {
        $users = User::with([
            'courses' => function ($query) {
                $query->with(['timetables', 'semester']);
            },
        ])
            ->where('id', Auth::id())
            ->firstOrFail();

        return $users;
    }

    public function getListStudent($id)
    {
        $users = Course::with('users')
            ->where('id', $id)
            ->firstOrFail();
        
        return $users;
    }

    public function updateUser($attributes = [])
    {
        User::where('id', Auth::id())->update([
            'fullname' => $attributes['fullname'],
            'dob' => $attributes['dob'],
            'address' => $attributes['address'],
        ]);
    }

    public function getCourseLecturer()
    {
        $users = User::with([
            'courses.users' => function ($query) {
                $query->where('role_id', config('auth.roles.lecturer'));
            },
        ])->findOrFail(Auth::id());

        return $users;
    }

    public function getCodeResetPass($id, $code)
    {
        User::where('id', $id)->update([
            'password' => bcrypt($code),
        ]);
    }

    public function resetPassAndDeleteCode($id, $pass)
    {
        User::where('id', $id)->update([
            'password' => bcrypt($pass),
        ]);
    }
}
