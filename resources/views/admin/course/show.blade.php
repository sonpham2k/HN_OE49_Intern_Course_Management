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
                            <th>{{ __('user') }}</th>
                            <th>{{ __('dob') }}</th>
                            <th>{{ __('address') }}</th>
                            <th>{{ __('email') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key++ }}</td>
                                <td>{{ $user->fullname }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->dob }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
