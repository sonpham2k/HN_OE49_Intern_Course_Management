@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('watch chart') }}</h2>
            <table>
                <td class="formTable1">
                    <form method="GET" action="{{ route('lecturers.chart') }}">
                        <table class="centerForm">
                            <div class="col-7 d-flex align-items-center">
                                <h6 class="mb-0">{{ __('text search') }}</h6>
                            </div>
                            <tr>
                                <td>
                                    <div class="marginDiv">
                                        <label class="form-label">{{ __('name') }}</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="marginDiv">
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="marginDiv">
                                        <button type="submit"
                                            class="btn btn-outline-primary btn-sm mb-0">{{ __('search') }}</button>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </table>

                        <div class="col-7 d-flex align-items-center">
                            <h6 class="mb-0">{{ __('total search') }}</h6>
                        </div>

                        <table class="centerForm data display">
                            <tr>
                                <td>
                                    <div class="marginTable">
                                        <label class="form-label">ID</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="marginTable">
                                        <label class="form-label">{{ __('name') }}</label>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="align-middle text-center">
                                        <div class="marginTable">{{ $user->id }}</div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="marginTable">{{ $user->fullname }}</div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="marginTable">
                                            <button value="{{ $user->id }}" name="watch"
                                                class="btn btn-outline-primary btn-sm mb-0">{{ __('watch search') }}</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </form>
                </td>
                <td class="formTable2 border">
                    <div class="col-lg-8">
                        <div class="card h-100">
                            <div class="col-10 d-flex align-items-center">
                                <h6 id="chartName" class="mb-0">{{ __('chart of') }}
                                    @isset($name)
                                        {{ $name }}
                                    @endisset
                                </h6>
                            </div>
                            <div>
                                <canvas id="myChart" class="chart"></canvas>
                            </div>
                        </div>
                    </div>
                </td>
            </table>
        </div>
    </div>
    @php
    $sub = __('subcribers');
    @endphp
    <script>
        window.year = '{!! json_encode($year) !!}';
        window.data = '{!! json_encode($data) !!}';
        window.sub = '{!! $sub !!}';
    </script>
    <script src="{{ asset('js/chart.js') }}" type="text/javascript"></script>
    </div>
@endsection
