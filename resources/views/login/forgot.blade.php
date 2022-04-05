@extends('layouts.app')

@section('content')
<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">{{ __('forgotyour') }}?
                                </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form role="form" class="text-start" method="POST" action="{{ route('send.mail') }}">
                                @csrf
                                <div>
                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-danger text-white">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success text-white">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                </div>
                                <b>{{ __('notifi reset') }}</b>
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Email: </label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div>
                                    @error('email')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button
                                        class="btn bg-gradient-primary w-70 my-4 mb-2">{{ __('send') }}</button>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('login') }}"
                                        class="btn bg-gradient-primary w-70 my-4 mb-2">{{ __('back') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
