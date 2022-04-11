@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('Add Notice') }}</h2>
            @if (session('success'))
                <div class="success">
                    <h3>
                        {{ session('success') }}
                    </h3>
                </div>
            @endif
            <div class="block">
                <form action="{{ route('posts.store') }}" method="post" id="form-1">
                    <table class="form">
                        <tr>
                            <td>
                                <label>{{ __('Post title') }}</label>
                            </td>
                            <td>
                                <input type="text" placeholder="{{ __('Enter Title...') }}" class="medium"
                                    name="title" id="title" />
                                @error('title')
                                    <span class="mess_error">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{{ __('Content') }}</label>
                            </td>
                            <td>
                                <input type="text" placeholder="{{ __('Enter Content...') }}" class="medium"
                                    name="content" id="content" />
                                @error('content')
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
