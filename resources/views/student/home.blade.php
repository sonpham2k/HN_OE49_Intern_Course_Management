@extends('layouts.student')
@section('content')
    <div class="container-fluid py-4">
        <div class="col-lg-4 col-md-6">
            <div class="card ">
                <div class="card-header pb-0">
                    <h6>{{ __('Dashboard') }}</h6>
                </div>
                <div class="card-body p-3">
                    <tbody>
                        <tr>
                            <td><a href=''>
                                    <span>{{ __('notice1') }} </span></h1>... (<span
                                        class='NgayTitle'>17/12/2021</span>)
                                </a></td>
                        </tr>
                        <tr>
                            <td><a href=''>
                                    <div class="notice"><span>{{ __('notice2') }} </span>
                                        ... (<span class='NgayTitle'>05/11/2021</span>)
                                    </div>
                                </a></td>
                        </tr>
                        <tr>
                            <td><a href=''>
                                    <div class="notice">
                                        <span>{{ __('notice3') }}</span>... (<span class='NgayTitle'>18/10/2021</span>)
                                    </div>
                                </a></td>
                        </tr>
                        <tr>
                            <td><a href=''>
                                    <div class="notice">
                                        <span>{{ __('notice4') }} </span>
                                        ... (<span class='NgayTitle'>24/09/2021</span>)
                                    </div>
                                </a></td>
                        </tr>
                        <tr>
                            <td><a href=''>
                                    <div class="notice">
                                        <span><span></span>{{ __('notice5') }}  </span></span></span>... (<span
                                            class='NgayTitle'>20/09/2021</span>)
                                    </div>
                                </a></td>
                        </tr>
                        <tr>
                            <td><a href=''>
                                    <div class="notice">
                                        <p><span>{{ __('notice6') }} </span>...
                                            (<span class='NgayTitle'>27/07/2021</span>)
                                    </div>
                                </a></td>
                        </tr>
                        <tr>
                            <td><a href=''>
                                    <div class="notice">
                                        <p><span>{{ __('notice7') }} </span>... (<span
                                                class='NgayTitle'>20/07/2021</span>)
                                    </div>
                                </a></td>
                        </tr>
                        <tr>
                            <td><a href=''>
                                    <div class="notice">
                                        {{ __('notice8') }}
                                        ... (<span class='NgayTitle'>04/07/2021</span>)
                                    </div>
                                </a></td>
                        </tr>
                    </tbody>
                </div>
            </div>
        </div>
    </div>
@endsection
