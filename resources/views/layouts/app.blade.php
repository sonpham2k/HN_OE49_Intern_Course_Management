<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title> {{ __('login') }} </title>
    <link href="{{ asset('bower_components/bower_project1/css/user/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('bower_components/bower_project1/css/user/nucleo-svg.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{  asset('bower_components/bower_project1/css/user/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
</head>

<body class="bg-gray-200">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid ps-2 pe-0">
                        <div class="collapse navbar-collapse" id="navigation">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                    <a class="dropdown-item" href="{{ route('change-language', ['vi']) }}">{{ __('vi') }} <img src=" {{ asset('bower_components/bower_project1/img/vn.png') }}"></a>
                                    <a class="dropdown-item" href="{{ route('change-language', ['en']) }}">{{ __('en') }} <img src=" {{ asset('bower_components/bower_project1/img/gb.png') }}"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    @yield('content')

    <script src="{{ asset('bower_components/bower_project1/js/user/core/popper.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/js/user/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/js/user/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/js/user/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/js/user/material-dashboard.min.js?v=3.0.0') }}"></script>
</body>

</html>
