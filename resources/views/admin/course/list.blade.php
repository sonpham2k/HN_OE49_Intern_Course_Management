@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('Courses List') }}</h2>
            @if (session('success'))
                <div class="alert alert-danger">
                    <h3>
                        {{ session('success') }}
                    </h3>
                </div>
            @endif
            <div class="block">
                <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th>{{ 'ID' }} </th>
                            <th>{{ __('Subject') }}</th>
                            <th>{{ __('credits') }}</th>
                            <th>{{ __('Lecturer Name') }}</th>
                            <th>{{ __('Numbers') }}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $key => $course)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    <a href="{{ route('courses.show', ['course' => $course]) }}">{{ $course->name }}</a>
                                </td>
                                <td>{{ $course->credits }}</td>
                                <td>
                                    @if (isset($course->users[0]->fullname))
                                        {{ $course->users[0]->fullname }}
                                    @endif
                                </td>
                                <td>{{ $course->numbers }}</td>
                                <td>
                                    <form style="display: flex; justify-content: center"
                                        action="{{ route('timetables.index', ['id' => $course->id]) }}" method="GET">
                                        <button type="submit" class="btn btn-blue">{{ __('View Timetable') }}</button>
                                        @csrf
                                    </form>
                                </td>
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
                                        <button type="submit" class=" btn btn-red"
                                            data-confirm="{{ __('pop up') }}?">{{ __('Delete') }}</button>
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
