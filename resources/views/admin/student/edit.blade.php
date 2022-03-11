@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('Edit Student') }}</h2>
            <div class="block">
                <form action="{{ route('students.update', ['student' => $student->id]) }}" method="post" id="form-1">
                    @method('PUT')
                    <table class="form">
                        <tr>
                            <td>
                                <label>{{ __('user') }}</label>
                            </td>
                            <td>
                                <input type="text" placeholder="{{ __('Enter Username...') }}" class="medium"
                                    name="username" id="username" value="{{ $student->username }}" />
                                @error('user')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('name') }}</label>
                            </td>
                            <td>
                                <input type="text" placeholder="{{ __('Enter Name...') }}" class="medium"
                                    name="fullname" id="fullname" value="{{ $student->fullname }}" />
                                @error('name')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('dob') }}</label>
                            </td>
                            <td>
                                <input class="form-control" id="date" class="medium" name="date" type="date"
                                    value="{{ $student->dob }}" />
                                @error('date')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('address') }}</label>
                            </td>
                            <td>
                                <input type="text" placeholder="{{ __('Enter Address...') }}" class="medium"
                                    name="address" id="address" value="{{ $student->address }}" />
                                @error('address')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('Email') }}</label>
                            </td>
                            <td>
                                <input type="text" placeholder="{{ __('Enter Email..') }}" class="medium"
                                    name="email" id="email" value="{{ $student->email }}" />
                                @error('email')
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
