<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTimeTableRequest;
use App\Http\Requests\UpdateTimeTableRequest;
use App\Models\Course;
use App\Models\TimeTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $course = Course::findOrFail($id);

        return view('admin.timetable.home', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddTimeTableRequest $request, $id)
    {
        $course = Course::findOrFail($id);
        $lecturer = $course->users()->where('role_id', config('auth.roles.lecturer'))->first();
        $check = true;
        if ($lecturer) {
            $lecturer->load('courses.timetables');
            foreach ($lecturer->courses as $course) {
                foreach ($course->timetables as $timetable) {
                    if ($timetable->day == $request->day && $timetable->lesson == $request->lesson) {
                        $check = false;
                        break;
                    }
                }
            }
        } else {
            foreach ($course->timetables as $timetable) {
                if ($timetable->day == $request->day && $timetable->lesson == $request->lesson) {
                    $check = false;
                    break;
                }
            }
        }
        if ($check == true) {
            DB::table('timetables')->insert([
                'day' => $request->day,
                'lesson' => $request->lesson,
                'course_id' => $id,
            ]);
            $request->session()->flash('success', __('Add Timetable Success'));
        } else {
            $request->session()->flash('alert', __('Add Timetable Fail'));
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $timetable_id)
    {
        $course = Course::findOrFail($id);
        $timetable1 = TimeTable::findOrFail($timetable_id);

        return view('admin.timetable.edit', compact('course', 'timetable1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimeTableRequest $request, $id, $timetable_id)
    {
        $course = Course::findOrFail($id);
        $lecturer = $course->users()->where('role_id', config('auth.roles.lecturer'))->first();
        $check = true;
        if ($lecturer) {
            $lecturer->load('courses.timetables');
            foreach ($lecturer->courses as $course) {
                foreach ($course->timetables as $timetable) {
                    if ($timetable->day == $request->day && $timetable->lesson == $request->lesson) {
                        $check = false;
                        break;
                    }
                }
            }
        } else {
            foreach ($course->timetables as $timetable) {
                if ($timetable->day == $request->day && $timetable->lesson == $request->lesson) {
                    $check = false;
                    break;
                }
            }
        }
        if ($check == true) {
            DB::table('timetables')
                ->findOrFail($timetable_id)
                ->update([
                    'day' => $request->day,
                    'lesson' => $request->lesson,
                ]);
            $request->session()->flash('success', __('Edit Timetable Success'));
        } else {
            $request->session()->flash('alert', __('Edit Timetable Fail'));
        }

        return redirect()->route('timetables.index', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timetable = TimeTable::findOrFail($id);
        $timetable->delete();

        return redirect()->back();
    }
}
