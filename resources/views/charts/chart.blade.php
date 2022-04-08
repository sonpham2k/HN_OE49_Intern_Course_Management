@extends('layouts.admin')
@section('content')
    <div class="grid_10">
        <div class="box round first grid">
            <h2>{{ __('watch chart') }}</h2>
            <table>
                <td class="formTable1">
                    <table class="centerForm">
                        <div class="col-7 d-flex align-items-center">
                            <h6 class="mb-0">{{ __('text search') }}</h6>
                        </div>
                        {{-- Khung nhập mã giảng viên --}}
                        <tr>
                            <td>
                                <div class="marginDiv">
                                    <label class="form-label">ID</label>
                                </div>
                            </td>
                            <td>
                                <div class="marginDiv">
                                    <input type="text" name="id" class="form-control">
                                </div>
                            </td>
                        </tr>
                        {{-- Khung nhập tên giảng viên --}}
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
                        {{-- Nút tìm kiếm --}}
                        <tr>
                            <td></td>
                            <td>
                                <div class="marginDiv">
                                    <button class="btn btn-outline-primary btn-sm mb-0">{{ __('search') }}</button>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                    {{-- Label thông báo nhập --}}
                    <div class="col-7 d-flex align-items-center">
                        <h6 class="mb-0">{{ __('total search') }}</h6>
                    </div>
                    {{-- Bảng trả về kết quả --}}
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
                        <tr>
                            <td class="align-middle text-center">
                                <div class="marginTable">
                                    1
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                <div class="marginTable">
                                    Đỗ Thành Vinh
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                <div class="marginTable">
                                    <button class="btn btn-outline-primary btn-sm mb-0">{{ __('watch search') }}</button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="formTable2 border">
                    <div class="widthBox">
                        <div class="col-lg-8">
                            <div class="card h-100">
                                <div class="col-10 d-flex align-items-center">
                                    <h6 class="mb-0">{{ __('chart') }}</h6>
                                </div>
                                <div id="chart" class="chart"></div>
                            </div>

                        </div>
                    </div>
                </td>
            </table>
        </div>
    </div>
    </div>
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('report_chart')",
            hooks: new ChartisanHooks()
                .colors()
                .datasets([{
                    type: 'bar',
                    fill: false,
                    color: '#708090'
                }])
        });
    </script>
@endsection
