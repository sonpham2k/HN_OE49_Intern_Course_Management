@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('Add Course') }}</h2>
            @if (isset($data))
                <div class="alert alert-danger">
                    <h3>
                        {{ $data }}
                    </h3>
                </div>
            @endif
            <div class="block">
                <form action="{{ route('courses.store') }}" method="post" id="form-1">
                    <table class="form">
                        <tr>
                            <td>
                                <label>{{ __('name') }}</label>
                            </td>
                            <td>
                                <input type="text" placeholder="{{ __('Enter Course name...') }}" class="medium"
                                    name="name" id="name" />
                                @error('name')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('credit') }}</label>
                            </td>
                            <td>
                                <input type="text" placeholder="{{ __('Enter credit..') }}" class="medium"
                                    name="credits" id="credits" />
                                @error('credits')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('semester') }}</label>
                            </td>
                            <td>
                                <select name="semester">
                                    @foreach ($semesters as $key => $semester)
                                        <option value="{{ $semester->begin }}{{ $semester->name }}"> Học kì
                                            {{ $semester->name }} năm học
                                            {{ $semester->begin }}-{{ $semester->begin + 1 }}
                                        </option>
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
