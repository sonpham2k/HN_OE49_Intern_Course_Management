@extends('layouts.lecturer')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">{{ __('ListStudent') }}</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                            {{ __('ID') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxl font-weight-bolder opacity-7 ps-2">
                                            {{ __('nameStudent') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                            {{ __('dobStudent') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                            {{ __('addressStudent') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $key = 1;
                                    @endphp
                                    @foreach ($users->users as $student)
                                        @if ($student->role_id == config('auth.roles.student'))
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $key++ }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-sm">{{ $student->fullname }}</h6>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <h6 class="mb-0 text-sm">{{ $student->dob }}</h6>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <h6 class="mb-0 text-sm">{{ $student->address }}</h6>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
