@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('Courses List') }}</h2>
            <div class="block">
                <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th>{{ 'ID' }} </th>
                            <th>{{ __('Subject') }}</th>
                            <th>{{ __('credits') }}</th>
                            <th>{{ __('Lecturer Name') }}</th>
                            <th>{{ __('Day') }}</th>
                            <th>{{ __('Lesson') }}</th>
                            <th>{{ __('semester') }}</th>
                            <th>{{ __('year') }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $key => $course)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->credits }}</td>
                                <td><a
                                        href="{{ route('courses.show', ['course' => $course]) }}">{{ $course->name }}</a>
                                </td>
                                <td>{{ $course->users->name }}</td>
                                <td>{{ $course->day }}</td>
                                <td>{{ $course->lesson }}</td>
                                <td>{{ $course->semester->name }}</td>
                                <td>{{ $course->semester->begin }} - {{ $course->semester->end }}</td>
                                <td>
                                    <form style="display: flex; justify-content: center"
                                        action="{{ route('courses.edit', ['course' => $course]) }}" method="GET">
                                        <button type="submit" class="btn btn-warning btn-sm">{{ __('Update') }}</button>
                                        @csrf
                                    </form>
                                </td>
                                <td>
                                    <form style="display: flex; justify-content: center"
                                        action="{{ route('courses.destroy', ['course' => $course]) }}" method="POST">
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning btn-sm">{{ __('Delete') }}</button>
                                        @csrf
                                    </form>
                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
