<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Semester\SemesterRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Notify\NotifyRepositoryInterface;

class StudentHomeController extends Controller
{
    protected $userRepo;
    protected $courseRepo;
    protected $semesterRepo;
    protected $postRepo;
    protected $notiRepo;

    public function __construct(
        UserRepositoryInterface $userRepo,
        CourseRepositoryInterface $courseRepo,
        SemesterRepositoryInterface $semesterRepo,
        PostRepositoryInterface $postRepo,
        NotifyRepositoryInterface $notiRepo
    ) {
        $this->userRepo = $userRepo;
        $this->courseRepo = $courseRepo;
        $this->semesterRepo = $semesterRepo;
        $this->postRepo = $postRepo;
        $this->notiRepo = $notiRepo;
    }

    public function home()
    {
        return view('student.home');
    }

    public function getTimeTable()
    {
        $semesters = $this->semesterRepo->getAll();

        $users = $this->userRepo->getTimeTableUser();

        return view('student.timetable', compact('users', 'semesters'));
    }

    public function searchCourse(Request $request)
    {
        $now = getdate();
        $year = $now['year'];
        $month = $now['mon'];
        switch ($month) {
            case config('auth.register.month-1'):
                $semesNow = config('auth.register.seme-1');
                break;
            case config('auth.register.month-2'):
                $semesNow = config('auth.register.seme-2');
                break;
            case config('auth.register.month-3'):
                $semesNow = config('auth.register.seme-3');
                break;
            default:
                $semesNow = config('auth.register.seme-0');
        }

        $semesters = $this->semesterRepo->getSemesterNow($semesNow, $year);

        $countCourses = $this->courseRepo->getCourse();

        $users = $this->userRepo->getCourseLecturer();

        $listCourse = $this->courseRepo->listCourse($semesters->id);

        $total = 0;
        foreach ($users->courses as $course) {
            if ($course->semester_id == $semesters->id) {
                $total += $course->credits;
            }
        }

        session()->put('totalCredit', $total);

        $listTimeTables = '';
        foreach ($users->courses as $course) {
            if ($course->semester_id == $semesters->id) {
                foreach ($course->timetables as $timetable) {
                    $listTimeTables = $listTimeTables . 'T' . $timetable->day . '(' . $timetable->lesson . ') ';
                }
            }
        }

        return view('student.registerCourse', [
            'users' => $users,
            'semesters' => $semesters,
            'countCourses' => $countCourses,
            'total' => $total,
            'listTimeTables' => $listTimeTables,
            'listCourse' => $listCourse,
        ]);
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
        $input = [
            'fullname' => $request->input('name'),
            'dob' => $request->input('date'),
            'address' => $request->input('address'),
        ];

        $this->userRepo->updateUser($input);
        $success = __('changeSucess');

        return redirect()
            ->route('student.edit')
            ->with('success', __('update success'));
    }

    public function listStudent($course_id)
    {
        $users = $this->courseRepo->listStudent($course_id);

        return view('student.liststudent', compact('users'));
    }

    public function deleteCourse($course_id)
    {
        $user = Auth::user();
        $course = $this->courseRepo->findCourse($course_id);

        foreach ($user->courses as $value) {
            if ($value->pivot->course_id == $course_id) {
                $course->update(['slot', $course->slot--]);
                $user->courses()->detach($course_id);
            }
        }

        return redirect()->back();
    }

    public function markAsRead($id)
    {
        $noti = $this->notiRepo->getNotify($id);
        if (!$noti->read_at) {
            $noti->markAsRead();
        }
        $post = $this->postRepo->find($noti->data["data"]["post_id"]);
        return view('student.notice', compact('post'));
    }

    public function markAsReadAll()
    {
        $userUnreadNoti = $this->notiRepo->getListUnRead();
        if ($userUnreadNoti) {
            $userUnreadNoti->markAsRead();
        }

        return redirect()->back();
    }

    public function registerCourse($course_id)
    {
        $course = $this->courseRepo->findCourse($course_id);
        $user = Auth::user();

        foreach ($user->courses as $value) {
            if ($value->pivot->course_id == $course_id) {
                session()->flash('overCredit', __('sloted registered'));

                return redirect()->back();
            }
        }

        if ($course->slot < $course->numbers) {
            if (session('totalCredit') + $course->credits > config('auth.credit.max')) {
                session()->flash('overCredit', __('errorCredit'));

                return redirect()->back();
            }

            $course->update(['slot', $course->slot++]);
            $user = Auth::user();
            $user->courses()->attach($course_id);
        }

        return redirect()->back();
    }
}
