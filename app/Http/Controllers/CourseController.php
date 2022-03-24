<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCourseRequest;
use App\Http\Requests\EditCourseRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Semester\SemesterRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $courseRepo;
    protected $semesterRepo;
    protected $userRepo;
    public function __construct(
        CourseRepositoryInterface $courseRepo,
        SemesterRepositoryInterface $semesterRepo,
        UserRepositoryInterface $userRepo
    ) {
        $this->courseRepo = $courseRepo;
        $this->semesterRepo = $semesterRepo;
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $courses = $this->courseRepo->getAllCourseWithLecturer();

        return view('admin.course.list', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->userRepo->getLecturer();
        $semesters = $this->semesterRepo->getAll();

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
        $this->userRepo->find($request->user, [
            'role_id' => config('auth.roles.lecturer')
        ]);
        $this->semesterRepo->find($request->semester);
        $count = $this->courseRepo->create([
            'name' => $request->name,
            'user' => $request->user,
            'credits' => $request->credits,
            'numbers' => $request->numbers,
            'semester_id' => $request->semester,
            'slot' => 0,
        ]);

        return redirect()
            ->route('timetables.index', ['id' => $count])
            ->with('success', __('Success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = $this->courseRepo->find($id);
        $users = $this->courseRepo->getStudentOfCourse($course);

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
        $course = $this->courseRepo->getCourseWithLecturer($id);
        $lecturers = $this->userRepo->getLecturer();
        $semesters = $this->semesterRepo->getAll();

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
        $this->userRepo->find($request->user);

        $this->courseRepo->update($id, [
            'name' => $request->name,
            'user' => $request->user,
            'credits' => $request->credits,
            'numbers' => $request->numbers,
            'semester_id' => $request->semester,
        ]);
        $course = $this->courseRepo->getCourseWithLecturer($id);
        if (isset($course->users[0])) {
            if ($course->users[0]->id != $request->user) {
                $course->users()->detach($course->users[0]->id);
                $course->users()->attach($request->user);
            }
        } else {
            $course->users()->attach($request->user);
        }

        return redirect()->route('courses.index')->with('success', __('Edit Success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->courseRepo->delete($id);

        return redirect()->back();
    }
}
