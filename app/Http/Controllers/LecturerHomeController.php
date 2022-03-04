<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateLecturerRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Course;
use App\Models\User;
use App\Models\Semester;

class LecturerHomeController extends Controller
{
    public function home()
    {
        return view('lecturer.home');
    }

    public function getTimeTable()
    {
        $semesters = Semester::all();

        $users = User::with([
            'courses' => function ($query) {
                $query->with('timetables', 'semesters');
            },
        ])
            ->where('id', Auth::id())
            ->firstOrFail();

        return view('lecturer.timetable', compact('users', 'semesters'));
    }

    public function listStudent($course_id)
    {
        $users = Course::with('users')
            ->where('id', $course_id)
            ->firstOrFail();

        return view('lecturer.liststudent', compact('users'));
    }
}
