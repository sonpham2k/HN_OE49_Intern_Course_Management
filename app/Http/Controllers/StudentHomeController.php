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

    public function searchCourse(Request $request)
    {
        $now = getdate();
        $year = $now['year'];
        $month = $now['mon'];
        if ($month == config('auth.register.month-1')) {
            $semesNow = config('auth.register.seme-1');
        } elseif ($month == config('auth.register.month-2')) {
            $semesNow = config('auth.register.seme-2');
        } elseif ($month == config('auth.register.month-3')) {
            $semesNow = config('auth.register.seme-3');
        } else {
            $semesNow = config('auth.register.seme-0');
        }
        $semesters = Semester::where('name', $semesNow)
            ->where('begin', $year)
            ->firstOrFail();

        $countCourses = Course::with(['users'])->get();

        $users = User::with([
            'courses.users' => function ($query) {
                $query->where('role_id', config('auth.roles.lecturer'));
            },
        ])->findOrFail(Auth::id());
        
        $listCourse = Course::with(['timetables', 'semester', 'users' => function ($query) {
            $query->where('role_id', config('auth.roles.lecturer'));
        }])
            ->where('semester_id', $semesters->id)
            ->orderBy('name')
            ->paginate(config('auth.paginate.register'));
                
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
        User::where('id', Auth::id())->update([
            'fullname' => $request->input('name'),
            'dob' => $request->input('date'),
            'address' => $request->input('address'),
        ]);
        $success = __('changeSucess');

        return redirect()
            ->route('student.edit')
            ->with('success', __('update success'));
    }

    public function listStudent($course_id)
    {
        $users = Course::with('users')
            ->where('id', $course_id)
            ->firstOrFail();

        return view('student.liststudent', compact('users'));
    }

    public function deleteCourse($course_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);

        foreach ($user->courses as $value) {
            if ($value->pivot->course_id == $course_id) {
                $course->update(['slot', $course->slot--]);
                $user->courses()->detach($course_id);
            }
        }

        return redirect()->back();
    }

    public function registerCourse($course_id)
    {
        $course = Course::findOrFail($course_id);
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
