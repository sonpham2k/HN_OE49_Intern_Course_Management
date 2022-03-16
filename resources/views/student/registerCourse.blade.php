@extends('layouts.student')
@section('content')
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
                @if (session('overCredit'))
                    <div class="alert alert-danger text-white">
                        <p>{{ session('overCredit') }}</p>
                    </div>
                @endif
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
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
                                @foreach ($listCourse as $course)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xxl">{{ $course->name }}</h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xl font-weight-bold">{{ $course->users[0]->fullname }}
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
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xl font-weight-bold">
                                                {{ $course->slot }}
                                            </span>
                                        </td>
                                        @php
                                            $totalTime = '';
                                        @endphp
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xl font-weight-bold">
                                                @foreach ($course->timetables as $timetable)
                                                    T{{ $timetable->day }}({{ $timetable->lesson }})
                                                    @php
                                                        $totalTime .= 'T' . $timetable->day . '(' . $timetable->lesson . ') ';
                                                    @endphp
                                                @endforeach
                                            </span>
                                        </td>
                                        {{-- Kiểm tra môn đã được đăng kí hay chưa --}}
                                        @php
                                            $courseID = $course->id;
                                            $count = 0;
                                            $checkTime = 0;
                                            $array = str_split($totalTime, 6);
                                            foreach ($array as $arr) {
                                                if (strpos($listTimeTables, $arr) != false) {
                                                    $checkTime++;
                                                    break;
                                                }
                                            }
                                            foreach ($users->courses as $course2) {
                                                if ($course2->id == $courseID) {
                                                    $count++;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        @if ($count == 1)
                                            <td class="align-middle text-center">
                                                <label class="btnRegistered">{{ __('choose registered') }}</label>
                                            </td>
                                        @else
                                            @if ($course->slot == $course->numbers)
                                                <td class="align-middle text-center">
                                                    <label class="btnOverSlot">{{ __('over slot') }}</label>
                                                </td>
                                            @else
                                                @if ($checkTime != 0)
                                                    <td class="align-middle text-center">
                                                        <label class="btnSameSchedule">{{ __('same schedule') }}</label>
                                                    </td>
                                                @else
                                                    <td class="align-middle text-center">
                                                        <form
                                                            action="{{ route('students-registCourse', ['course_id' => $course->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="submit" class="btn btn-sm mb-0 btnRegister"
                                                                value="{{ __('choose register') }}"></a>
                                                        </form>
                                                    </td>
                                                @endif
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                        </table>
                    </div>
                    {{ $listCourse->links() }}
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
                                                <span class="text-secondary text-xl font-weight-bold">
                                                    @foreach ($course->timetables as $timetable)
                                                        T{{ $timetable->day }}({{ $timetable->lesson }})
                                                    @endforeach
                                                </span>
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
                                                    <input class="btn btn-link text-danger text-gradient btn-delete"
                                                        type="submit" class="btn-delete"
                                                        data-confirm="{{ __('pop up') }}?" value="{{ __('delete') }}">
                                                </td>
                                            </form>
                                        </tr>
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
