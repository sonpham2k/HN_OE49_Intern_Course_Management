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
                    <div class="centerForm">
                        <b>{{ __('semester') }}: </b>
                        <select name="semester">
                            @foreach ($semesters as $key => $semester)
                                <option value="{{ $semester->begin }}{{ $semester->name }}"> {{ __('semester') }}
                                    {{ $semester->name }} {{ __('year') }}
                                    {{ $semester->begin }}-{{ $semester->begin + 1 }}
                                </option>
                            @endforeach
                        </select>
                        <input type="submit" value="{{ __('search') }}">
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxl text-center font-weight-bolder opacity-7 ps-2">
                                            {{ __('name course') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                            {{ __('lecture') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxl font-weight-bolder opacity-7 ps-2">
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
                                            {{ __('choose register') }}
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
                                            <span class="text-secondary text-xl font-weight-bold">Đỗ Thanh Hà Anh</span>
                                        </td>
                                        <td>
                                            <p class="text-secondary text-xl font-weight-bold mb-0">3</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xl font-weight-bold">60</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xl font-weight-bold">12</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xl font-weight-bold">T2(2)</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input ms-auto" type="checkbox"
                                                    id="flexSwitchCheckDefault1">
                                            </div>
                                        </td>
                                    </tr>
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
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="">
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
