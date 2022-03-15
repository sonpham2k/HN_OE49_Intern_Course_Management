@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('Lecturers List') }}</h2>
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
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lecturers as $key => $lecturer)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td><a
                                        href="{{ route('lecturers.show', ['lecturer' => $lecturer]) }}">{{ $lecturer->fullname }}</a>
                                </td>
                                <td>{{ $lecturer->username }}</td>
                                <td>{{ $lecturer->dob }}</td>
                                <td>{{ $lecturer->address }}</td>
                                <td>{{ $lecturer->email }}</td>
                                <td>
                                    <form style="display: flex; justify-content: center"
                                        action="{{ route('lecturers.edit', ['lecturer' => $lecturer]) }}" method="GET">
                                        <button type="submit" class="btn btn-warning btn-sm">{{ __('Update') }}</button>
                                        @csrf
                                    </form>
                                </td>
                                <td>
                                    <form style="display: flex; justify-content: center"
                                        action="{{ route('lecturers.destroy', ['lecturer' => $lecturer]) }}"
                                        method="POST">
                                        @method('DELETE')
                                        <button type="submit" class=" btn btn-red"
                                            data-confirm="{{ __('pop up lecturer') }}?">{{ __('Delete') }}</button>
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
