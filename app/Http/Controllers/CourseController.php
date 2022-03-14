<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCourseRequest;
use App\Http\Requests\EditCourseRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Semester;
use App\Models\User;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::with(['users' => function ($query) {
            return $query->where('role_id', config('auth.roles.lecturer'));
        }])->get();

        return view('admin.course.list', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role_id', config('auth.roles.lecturer'))->get();
        $semesters = Semester::all();

        return view('admin.course.add', compact('users', 'semesters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCourseRequest $request)
    {
        $lecturer = User::where('role_id', config('auth.roles.lecturer'))->findOrFail($request->user);
        $semester = Semester::findOrFail($request->semester);
        DB::table('courses')->insert([
            'name' => $request->name,
            'credits' => $request->credits,
            'numbers' => $request->numbers,
            'semester_id' => $request->semester,
        ]);
        $count = Course::all()->count() + 1;
        $course = Course::findOrFail($count);
        $course->users()->attach($request->user);
        $request->session()->flash('success', __('Success'));

        return redirect()->route('courses.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);
        $users = $course->users
            ->where('role_id', config('auth.roles.student'));

        return view('admin.course.show', compact('users', 'course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::with(['users' => function ($query) {
            return $query->where('role_id', config('auth.roles.lecturer'));
        }])->findOrFail($id);
        $lecturers = User::where('role_id', config('auth.roles.lecturer'))->get();
        $semesters = Semester::all();

        return view('admin.course.edit', compact('course', 'semesters', 'lecturers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCourseRequest $request, $id)
    {
        $lecturer = User::findOrFail($request->user);
        DB::table('courses')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'credits' => $request->credits,
                'numbers' => $request->numbers,
                'semester_id' => $request->semester,
            ]);
        $course = Course::with(['users' => function ($query) {
            return $query->where('role_id', config('auth.roles.lecturer'));
        }])->findOrFail($id);
        if ($course->users[0]->id != $request->user) {
            $course->users()->detach($course->users[0]->id);
            $course->users()->attach($request->user);
        }
        $request->session()->flash('success', __('Edit Success'));

        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->users()->detach();
        $course->delete();

        return redirect()->back();
    }
}
