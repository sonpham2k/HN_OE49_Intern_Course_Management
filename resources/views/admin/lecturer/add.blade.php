@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('Add Lecturer') }}</h2>
            @if (isset($data))
                <div class="alert alert-danger">
                    <h3>
                        {{ $data }}
                    </h3>
                </div>
            @endif
            <div class="block">
                <form action="{{ route('lecturers.store') }}" method="post" id="form-1">
                    <table class="form">
                        <tr>
                            <td>
                                <label>{{ __('user') }}</label>
                            </td>
                            <td>
                                <input type="text" placeholder="{{ __('Enter Username...') }}" class="medium"
                                    name="username" id="username" />
                                @error('username')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('pass') }}</label>
                            </td>
                            <td>
                                <input type="text" placeholder="{{ __('Enter pass..') }}" class="medium"
                                    name="pass" id="pass" />
                                @error('pass')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('name') }}</label>
                            </td>
                            <td>
                                <input type="text" placeholder="{{ __('Enter Student name...') }}" class="medium"
                                    name="name" id="name" />
                                @error('name')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('address') }}</label>
                            </td>
                            <td>
                                <input type="text" placeholder="{{ __('Enter Student address...') }}"
                                    class="medium" name="address" id="address" />
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
                                    name="email" id="email" />
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
