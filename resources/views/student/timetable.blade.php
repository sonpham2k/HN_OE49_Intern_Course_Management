@extends('layouts.student')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">{{ __('timeTable') }}</h6>
                        </div>
                    </div>
                    <form method="GET">
                        <div class="centerForm">
                            <b>Học kì: </b>
                            <select name="semester">
                                @foreach ($semesters as $key => $semester)
                                    <option value="{{ $semester->begin }}{{ $semester->name }}"> Học kì
                                        {{ $semester->name }} năm học
                                        {{ $semester->begin }}-{{ $semester->begin + 1 }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="submit" value="{{ __('search') }}">
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                                {{ __('ID') }}</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxl font-weight-bolder opacity-7 ps-2">
                                                {{ __('Subject') }}</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                                {{ __('Day') }}</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                                {{ __('Lesson') }}</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                                {{ __('semester') }}</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                                {{ __('year') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($_GET['semester']))
                                            @php
                                                $key = 1;
                                                $semesValue = substr($_GET['semester'], -1);
                                                $beginValue = substr($_GET['semester'], 0, 4);
                                            @endphp
                                            @foreach ($users->courses as $course)
                                                @if ($course->semester->begin == $beginValue && $course->semester->name == $semesValue)
                                                    @foreach ($course->timetables as $timetable)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm">{{ $key++ }}</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h6 class="mb-0 text-sm"><a class="underline"
                                                                    href="{{ route('liststudent-student', ['course_id' => $course->id]) }}">{{ $course->name }}</a>
                                                                </h6>
                                                            </td>
                                                            <td class="align-middle text-center text-sm">
                                                                <h6 class="mb-0 text-sm">{{ $timetable->day }}</h6>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <h6 class="mb-0 text-sm">{{ $timetable->lesson }}</h6>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <h6 class="mb-0 text-sm">
                                                                    {{ $course->semester->name }}</h6>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <h6 class="mb-0 text-sm">
                                                                    {{ $course->semester->begin }}-{{ $course->semester->end }}
                                                                </h6>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
