<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateLecturerRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Report\ReportRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Semester\SemesterRepositoryInterface;

class LecturerHomeController extends Controller
{
    protected $userRepo;
    protected $courseRepo;
    protected $semesterRepo;
    protected $reportRepo;

    public function __construct(
        UserRepositoryInterface $userRepo,
        CourseRepositoryInterface $courseRepo,
        SemesterRepositoryInterface $semesterRepo,
        ReportRepositoryInterface $reportRepo
    ) {
        $this->userRepo = $userRepo;
        $this->courseRepo = $courseRepo;
        $this->semesterRepo = $semesterRepo;
        $this->reportRepo = $reportRepo;
    }

    public function home()
    {
        return view('lecturer.home');
    }

    public function getTimeTable()
    {
        $semesters = $this->semesterRepo->getAll();

        $users = $this->userRepo->getTimeTableUser();

        return view('lecturer.timetable', compact('users', 'semesters'));
    }

    public function listStudent($course_id)
    {
        $users = $this->userRepo->getListStudent($course_id);

        return view('lecturer.liststudent', compact('users'));
    }

    public function show($id)
    {
        return redirect()->route('timetable-lecturer');
    }

    public function edit()
    {
        $user = Auth::user();
        if (!$user) {
            abort('404', 'Not Found');
        }

        return view('lecturer.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $input = [
            'fullname' => $request->input('name'),
            'dob' => $request->input('date'),
            'address' => $request->input('address'),
        ];

        $this->userRepo->updateUser($input);
        $success = __('changeSucess');

        return redirect()
            ->route('lecturer.edit')
            ->with('success', __('update success'));
    }

    public function viewChart(Request $request)
    {
        $users = $this->userRepo->searchAllLecturer($request->name);
        $data = [];
        $year = [];
        $name = "";
        if (isset($request->watch)) {
            $result = $this->reportRepo->findReportByUser($request->watch);
            $name = $result[0]->user->fullname;
            foreach ($result as $item) {
                $year[] = $item->year;
                $data[] = $item->subscribers;
            }
        }

        return view('charts.chart', compact('users', 'year', 'data', 'name'));
    }
}
