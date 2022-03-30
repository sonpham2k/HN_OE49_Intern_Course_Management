<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTimeTableRequest;
use App\Http\Requests\UpdateTimeTableRequest;
use App\Models\Course;
use App\Models\TimeTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\TimeTable\TimeTableRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $courseRepo;
    protected $timetableRepo;
    protected $userRepo;
    public function __construct(
        CourseRepositoryInterface $courseRepo,
        TimeTableRepositoryInterface $timetableRepo,
        UserRepositoryInterface $userRepo
    ) {
        $this->courseRepo = $courseRepo;
        $this->timetableRepo = $timetableRepo;
        $this->userRepo = $userRepo;
    }

    public function index($id)
    {
        $course = $this->courseRepo->find($id);

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
        $course = $this->courseRepo->find($id);
        $lecturer = $this->courseRepo->getLecturerOfCourse($id);
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
            $this->timetableRepo->insertDB([
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
        $course = $this->courseRepo->find($id);
        $timetable1 = $this->timetableRepo->find($timetable_id);

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
        $course = $this->courseRepo->find($id);
        $lecturer = $this->courseRepo->getLecturerOfCourse($id);
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
            $this->timetableRepo->update($timetable_id, [
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
        $this->timetableRepo->delete($id);

        return redirect()->back();
    }
}
