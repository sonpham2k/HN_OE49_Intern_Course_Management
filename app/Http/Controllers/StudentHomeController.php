<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Course;
use App\Models\User;
use App\Models\Semester;

class StudentHomeController extends Controller
{
    public function home()
    {
        return view('student.home');
    }

    public function getTimeTable()
    {
        $semesters = Semester::all();

        $users = User::with([
            'courses' => function ($query) {
                $query->with(['timetables', 'semester']);
            },
        ])
            ->where('id', Auth::id())
            ->firstOrFail();

        return view('student.timetable', compact('users', 'semesters'));
    }

    public function registerCourse($course_id)
    {
        //
    }
    public function show($id)
    {
        return redirect()->route('timetable-student');
    }

    public function edit()
    {
        $user = Auth::user();
        if (!$user) {
            abort('404');
        }

        return view('student.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        User::where('id', Auth::id())->update([
            'fullname' => $request->input('name'),
            'dob' => $request->input('date'),
            'address' => $request->input('address'),
        ]);
        $success = __('changeSucess');

        return redirect()
            ->route('students.edit')
            ->with('success');
    }
}
