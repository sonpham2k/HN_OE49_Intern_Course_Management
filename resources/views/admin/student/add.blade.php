@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('Add Student') }}</h2>
            @if (session('success'))
                <div class="success">
                    <h3>
                        {{ session('success') }}
                    </h3>
                </div>
            @endif
            <div class="block">
                <form action="{{ route('students.store') }}" method="post" id="form-1">
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
                                <input type="text" placeholder="{{ __('Enter Password...') }}" class="medium"
                                    name="password" id="password" type="password" />
                                @error('password')
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
                                    name="fullname" id="name" />
                                @error('fullname')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('dob') }}</label>
                            </td>
                            <td>
                                <input class="form-control" id="date" class="medium" name="date" type="date" />
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
                                    name="address" id="address" />
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
                                <input type="text" placeholder="{{ __('Enter Email...') }}" class="medium"
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
