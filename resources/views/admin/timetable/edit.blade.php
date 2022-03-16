@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('Timetable of course') }}
                {{ $course->name }}
            </h2>
            @if (session('success'))
                <div class="success">
                    <h3>
                        {{ session('success') }}
                    </h3>
                </div>
            @endif
            @if (session('alert'))
                <div class="alert">
                    <h3>
                        {{ session('alert') }}
                    </h3>
                </div>
            @endif
            <div class="block">
                <form action="{{ route('timetables.update', ['id' => $course->id, 'timetable_id' => $timetable1->id]) }}"
                    method="post" id="form-1">
                    @method('PATCH')
                    <table class="form">
                        <tr>
                            <td>
                                <label>{{ __('Day') }}</label>
                            </td>
                            <td>
                                <input type="text" value="{{ $timetable1->day }}" class="medium" name="day"
                                    id="day" />
                                @error('day')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('Lesson') }}</label>
                            </td>
                            <td>
                                <input type="text" value="{{ $timetable1->lesson }}" class="medium"
                                    name="lesson" id="lesson" type="text" />
                                @error('lesson')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        @csrf
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value={{ __('Edit Timetable') }} />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="block">
                <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }} </th>
                            <th>{{ __('Day') }}</th>
                            <th>{{ __('Lesson') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course->timetables as $key => $timetable)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $timetable->day }}</td>
                                <td>{{ $timetable->lesson }}</td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
