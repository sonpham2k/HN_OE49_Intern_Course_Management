@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('Edit Course') }}</h2>
            @if (isset($data))
                <div class="alert alert-danger">
                    <h3>
                        {{ $data }}
                    </h3>
                </div>
            @endif
            <div class="block">
                <form action="{{ route('courses.update', ['course' => $course->id]) }}" method="post" id="form-1">
                    @method('PATCH')
                    <table class="form">
                        <tr>
                            <td>
                                <label>{{ __('Course name') }}</label>
                            </td>
                            <td>
                                <input type="text" class="medium" value="{{ $course->name }}" name="name"
                                    id="name" />
                                @error('name')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('credits') }}</label>
                            </td>
                            <td>
                                <input type="text" class="medium" value="{{ $course->credits }}" name="credits"
                                    id="credits" />
                                @error('credits')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('Numbers') }}</label>
                            </td>
                            <td>
                                <input type="text" class="medium" value="{{ $course->numbers }}" name="numbers"
                                    id="numbers" />
                                @error('numbers')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('Lecturer') }}</label>
                            </td>
                            <td>
                                <select name="user">
                                    @foreach ($lecturers as $key => $lecturer)
                                        @if ($lecturer->id == $course->users[0]->id)
                                            <option selected="selected" value="{{ $lecturer->id }}">
                                                {{ $lecturer->fullname }}
                                            </option>
                                        @else
                                            <option value="{{ $lecturer->id }}">
                                                {{ $lecturer->fullname }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('user')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        <tr>
                            <td>
                                <label>{{ __('semester') }}</label>
                            </td>
                            <td>
                                <select name="semester">
                                    @foreach ($semesters as $key => $semester)
                                        @if ($semester->id == $course->semester_id)
                                            <option selected="selected" value="{{ $semester->id }}"> Học kì
                                                {{ $semester->name }} năm học
                                                {{ $semester->begin }}-{{ $semester->begin + 1 }}
                                            </option>
                                        @else
                                            <option value="{{ $semester->id }}"> Học kì
                                                {{ $semester->name }} năm học
                                                {{ $semester->begin }}-{{ $semester->begin + 1 }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('semester')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        @csrf
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value={{ __('Save') }} />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
