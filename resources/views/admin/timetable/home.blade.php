@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('Timetable of course') }}
                {{ $course->name }}
            </h2>
            @if (session('msg'))
                <div class="alert alert-danger">
                    <h3>
                        {{ session('msg') }}
                    </h3>
                </div>
            @endif
            <div class="block">
                <form action="{{ route('timetables.store', ['id' => $course->id]) }}" method="post" id="form-1">
                    <table class="form">
                        <tr>
                            <td>
                                <label>{{ __('Day') }}</label>
                            </td>
                            <td>
                                <input type="text" placeholder="{{ __('Enter Day...') }}" class="medium" name="day"
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
                                <input type="text" placeholder="{{ __('Enter Lesson...') }}" class="medium"
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
                                <input type="submit" name="submit" Value={{ __('Add Timetable') }} />
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
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course->timetables as $key => $timetable)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $timetable->day }}</td>
                                <td>{{ $timetable->lesson }}</td>
                                <td>
                                    <form style="display: flex; justify-content: center"
                                        action="{{ route('timetables.edit', ['id' => $course->id, 'timetable_id' => $timetable->id]) }}"
                                        method="GET">
                                        <button type="submit" class="btn btn-warning">{{ __('Update') }}</button>
                                        @csrf
                                    </form>
                                </td>
                                <td>
                                    <form style="display: flex; justify-content: center"
                                        action="{{ route('timetables.destroy', ['id' => $timetable->id]) }}"
                                        method="POST">
                                        @method('DELETE')
                                        <button type="submit" class=" btn btn-red"
                                            data-confirm="{{ __('pop up timetable') }}?">{{ __('Delete') }}</button>
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
