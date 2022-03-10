@extends('layouts.student')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ __('list course') }}</h6>
                    </div>
                </div>
                <form method="GET">
                    <div class="card-body px-0 pb-2">
                        <div class="centerType">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">{{ __('type') }}</label>
                                    <input type="text" class="form-control">
                                    <input type="submit" class="btn btn-outline-primary btn-sm mb-0"
                                        value="{{ __('search') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxl text-center font-weight-bosder opacity-7 ps-2">
                                            {{ __('name course') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                            {{ __('lecture') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                            {{ __('credit course') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                            {{ __('total student') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                            {{ __('total register') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                            {{ __('time table') }}</th>
                                        <th class="text-secondary text-uppercase text-xxl opacity-7 font-weight-bolder">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($course as $courses)
                                        @foreach ($courses->timetables as $timetable)
                                            @foreach ($courses->users as $teacher)
                                                @if ($teacher->role_id == config('auth.roles.lecturer'))
                                                    <tr>
                                                        <td class="align-middle text-center">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xxl">{{ $courses->name }}</h6>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xl font-weight-bold">{{ $teacher->fullname }}
                                                            </span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xl font-weight-bold">{{ $courses->credits }}</span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xl font-weight-bold">{{ $courses->numbers }}</span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xl font-weight-bold">{{ $count }}</span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span
                                                                class="text-secondary text-xl font-weight-bold">T{{ $timetable->day }}({{ $timetable->lesson }})</span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <button type="button"
                                                                class="btn btn-sm mb-0 btnRegister">Register</button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">{{ __('list registerd') }}</h6>
                </div>
            </div>
            <div class="table-responsive p-0">
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxl text-center font-weight-bolder opacity-7">
                                        {{ __('name course') }}</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                        {{ __('lecture') }}</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                        {{ __('credit course') }}</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                        {{ __('time table') }}</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                        {{ __('delete') }}
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-9">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle text-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xl">Lập trình hướng đối tượng 1</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xl font-weight-bold">Đỗ Thanh Hà</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xl font-weight-bold">3</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xl font-weight-bold">T2(2)</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                                            onclick="return confirm('{{ __('pop up') }}?')" href="">
                                            <i class="material-icons text-xxxl me-2">delete</i>
                                            <span
                                                class="text-secondary text-xxxl font-weight-bold">{{ __('delete') }}</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
