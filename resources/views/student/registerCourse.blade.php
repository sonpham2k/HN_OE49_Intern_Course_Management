@extends('layouts.student')
@section('content')
    @php
        $users = $compactData[0];
        $courses = $compactData[1];
        $semesters = $compactData[2];
        $countCourses = $compactData[3];
        $total = $compactData[4];
        $listTimeTable = $compactData[5];
    @endphp
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid">
            <div class="row">
                <h4>{{ __('register') }} - {{ __('semester') }} {{ $semesters->name }} {{ __('year') }}
                    {{ $semesters->begin }} - {{ $semesters->end }}</h4>
                <h class="rangeCredit">{{ __('credit range') }} [{{ config('auth.credit.min') }},
                    {{ config('auth.credit.max') }}]</h>
            </div>
        </div>
        
        <div class="container-fluid py-4">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ __('list course') }}</h6>
                    </div>
                </div>
                <form method="GET" action="{{ route('students.searchCourse') }}">
                    <div class="card-body px-0 pb-2">
                        <div class="centerType">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">{{ __('type') }}</label>
                                    <input type="text" name="name_course" class="form-control">
                                    <button type="submit" class="btn btn-outline-primary btn-sm mb-0">
                                        {{ __('search') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        @if ($total >= config('auth.credit.max'))
                            <div class="divOverCreadit">{{ __('over credit') }}</div>
                        @else
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxl text-center font-weight-bosder opacity-7 ps-2">
                                            {{ __('name course') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                            {{ __('lecture') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                            {{ __('credit course') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                            {{ __('total student') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                            {{ __('total register') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                            {{ __('time table') }}</th>
                                        <th class="text-secondary text-uppercase text-xxl opacity-7 font-weight-bolder">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        @foreach ($course->timetables as $timetable)
                                            @foreach ($course->users as $teacher)
                                                @if ($teacher->role_id == config('auth.roles.lecturer'))
                                                    <tr>
                                                        <td class="align-middle text-center">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xxl">{{ $course->name }}</h6>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xl font-weight-bold">{{ $teacher->fullname }}
                                                            </span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xl font-weight-bold">{{ $course->credits }}</span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xl font-weight-bold">{{ $course->numbers }}</span>
                                                        </td>

                                                        {{-- Tính số sinh viên đăng kí môn này --}}
                                                        @php
                                                            $countRegist = 0;
                                                            foreach ($countCourses as $countCourse) {
                                                                if ($countCourse->id == $course->id) {
                                                                    foreach ($countCourse->users as $countUser) {
                                                                        if ($countUser->role_id == config('auth.roles.student')) {
                                                                            $countRegist++;
                                                                        } else {
                                                                            $countRegist + 0;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xl font-weight-bold">
                                                                {{ $countRegist }}
                                                            </span>
                                                        </td>

                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xl font-weight-bold">T{{ $timetable->day }}({{ $timetable->lesson }})</span>
                                                        </td>

                                                        {{-- Kiểm tra môn đã được đăng kí hay chưa --}}
                                                        @php
                                                            $courseID = $course->id;
                                                            $count = 0;
                                                            $checkTime = strpos($listTimeTable, 'T' . $timetable->day . '(' . $timetable->lesson . ')');
                                                            foreach ($users->courses as $course2) {
                                                                if ($course2->id == $courseID) {
                                                                    $count++;
                                                                } else {
                                                                    $count + 0;
                                                                }
                                                            }
                                                        @endphp
                                                        @if ($count == 1)
                                                            <td class="align-middle text-center">
                                                                <label
                                                                    class="btnRegistered">{{ __('choose registered') }}</label>
                                                            </td>
                                                        @else
                                                            @if ($countRegist == $course->numbers)
                                                                <td class="align-middle text-center">
                                                                    <label
                                                                        class="btnOverSlot">{{ __('over slot') }}</label>
                                                                </td>
                                                            @else
                                                                @if ($checkTime != false)
                                                                    <td class="align-middle text-center">
                                                                        <label
                                                                            class="btnSameSchedule">{{ __('same schedule') }}</label>
                                                                    </td>
                                                                @else
                                                                    <td class="align-middle text-center">
                                                                        <form action="{{ route('students-registCourse', ['course_id' => $course->id]) }}" method="POST">
                                                                            @csrf
                                                                            <input type="submit"
                                                                                class="btn btn-sm mb-0 btnRegister"
                                                                                value="{{ __('choose register') }}"></a>
                                                                        </form>
                                                                    </td>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                        @endif
                        </table>
                    </div>
                    {{ $courses->links() }}
                </div>
            </div>

        </div>
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">{{ __('list registerd') }}</h6>
                </div>
            </div>
            <div class="table-responsive p-0">
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxl text-center font-weight-bolder opacity-7">
                                        {{ __('name course') }}</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                        {{ __('lecture') }}</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                        {{ __('credit course') }}</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                        {{ __('time table') }}</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                        {{ __('delete') }}
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-9">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalCredit = 0;
                                    $totalCourse = 0;
                                @endphp
                                @foreach ($users->courses as $course)
                                    @if ($course->semester_id == $semesters->id)
                                        @foreach ($course->timetables as $timetable)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-xl">{{ $course->name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xl font-weight-bold">{{ $course->users[0]->fullname }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xl font-weight-bold">{{ $course->credits }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xl font-weight-bold">T{{ $timetable->day }}({{ $timetable->lesson }})</span>
                                                </td>
                                                @php
                                                    $totalCredit += $course->credits;
                                                    $totalCourse = $totalCourse + 1;
                                                @endphp
                                                <form
                                                    action='{{ route('students-deleteCourse', ['course_id' => $course->id]) }}'
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <td class="align-middle text-center">
                                                        <input
                                                            class="btn btn-link text-danger text-gradient btn-delete"
                                                            type="submit" class="btn-delete"
                                                            data-confirm="{{ __('pop up') }}?"
                                                            value="{{ __('delete') }}">
                                                    </td>
                                                </form>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label class="form-label">
                    <h6>{{ __('total course') }} {{ $totalCourse }}</h6>
                </label>
            </div>
            <div class="col">
                <label class="form-label">
                    <h6>{{ __('total credit') }} {{ $totalCredit }}</h6>
                </label>
            </div>
        </div>
    </main>
@endsection
