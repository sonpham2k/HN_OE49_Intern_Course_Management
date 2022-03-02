<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateLecturerRequest;
use App\Models\Course;
use App\Models\User;

class LecturerHomeController extends Controller
{
    public function home()
    {
        return view('lecturer.home');
    }

    public function timeTable()
    {
        $users = User::with(['courses' => function ($query) {
            $query->with('timetables');
        }])
            ->where('id', Auth::user()->id)
            ->firstOrFail();

        return view('lecturer.timetable', compact('users'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('lecturer.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->findOrFail();
        $user->fullname = $request->fullname;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->save();

        return view('lecturer.edit');
    }

    public function listStudent($course_id)
    {
        $users = Course::with('users')
            ->where('id', $course_id)
            ->firstOrFail();

        return view('lecturer.liststudent', compact('users'));
    }
}
