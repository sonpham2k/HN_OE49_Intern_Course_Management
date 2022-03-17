@extends('layouts.lecturer')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3 center">{{ __('profile') }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success text-white">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="col-20 col-xl-4 centerForm">
        <div class="card card-plain h-100">
            <div class="card my-4">
                <form method="POST" role="form" class="text-start" action="{{ route('lecturer.update') }}">
                    @method("PUT")
                    @csrf
                    {{-- Full name --}}
                    <div class="input-group input-group-outline mb-2">
                        <label class="label">{{ __('name') }}:</label>
                    </div>
                    <div class="input-group input-group-outline mb-2">
                        <input type="text" name="name" class="form-control" value="{{ $user->fullname }}">
                    </div>
                    @error('name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                    {{-- DOB --}}
                    <div class="input-group input-group-outline mb-5">
                        <label class="form-label">{{ __('dob') }}:</label>
                    </div>
                    <div class="input-group input-group-outline mb-2">
                        <input class="form-control" id="date" name="date" type="date" value="{{ $user->dob }}" />
                    </div>
                    @error('date')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                    {{-- Address --}}
                    <div class="input-group input-group-outline mb-5">
                        <label class="form-label">{{ __('address') }}:</label>
                    </div>
                    <div class="input-group input-group-outline mb-2">
                        <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                    </div>
                    @error('address')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                    {{-- button --}}
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-primary w-70 my-4 mb-2">{{ __('save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
