@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('Students List of course:') }}
                @if (isset($course))
                    {{ $course->name }}
                @endif
            </h2>
            <div class="block">
                <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th>{{ 'ID' }} </th>
                            <th>{{ __('name') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course->users as $key => $user)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $user->name }}</td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
