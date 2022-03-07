@extends('layouts.student')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">{{ __('timeTable') }}</h6>
                        </div>
                    </div>
                    <form method="GET">
                        <div class="centerForm">
                            <b>Học kì: </b>
                            <select name="semester">
                                <option></option>
                            </select>
                            <input type="submit" value="{{ __('search') }}">
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
                                                {{ __('Subject') }}</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                                {{ __('Day') }}</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                                {{ __('Lesson') }}</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                                {{ __('semester') }}</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxl font-weight-bolder opacity-7">
                                                {{ __('year') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
