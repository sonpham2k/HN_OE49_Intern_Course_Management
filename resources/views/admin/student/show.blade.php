@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('Course List of student:') }}
                @if (isset($user))
                    {{ $user->name }}
                @endif
            </h2>
            <div class="block">
                <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th>{{ 'ID' }} </th>
                            <th>{{ __('course') }}</th>
                            <th>{{ __('lecturer') }}</th>
                            <th>{{ __('semester') }}</th>
                            <th>{{ __('year') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->courses as $key => $course)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->users[0]->fullname }}</td>
                                <td>{{ $course->semester->name }}</td>
                                <td>{{ $course->semester->begin }} - {{ $course->semester->end }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
