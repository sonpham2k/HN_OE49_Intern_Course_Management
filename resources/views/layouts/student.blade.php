<!--
    =========================================================
    * Material Dashboard 2 - v3.0.0
    =========================================================
    
    * Product Page: https://www.creative-tim.com/product/material-dashboard
    * Copyright 2021 Creative Tim (https://www.creative-tim.com)
    * Licensed under MIT (https://www.creative-tim.com/license)
    * Coded by Creative Tim
    
    =========================================================
    
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/bower_project1/css/user/font/index') }}" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('bower_components/bower_project1/css/user/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('bower_components/bower_project1/css/user/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="{{ asset('bower_components/bower_project1/js/user/fontawesome/index.js') }}" crossorigin="anonymous">
    </script>
    <!-- Material Icons -->
    <link href="{{ asset('bower_components/bower_project1/css/user/icon/index') }}" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('bower_components/bower_project1/css/user/material-dashboard.css?v=3.0.0') }}"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('bower_components/bower_project1/css/user/app.css') }}" />
    <script type="text/javascript" src="{{ asset('bower_components/jquery-1.11.3.min/index.js') }}"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" target="_blank">
                <span class="ms-1 font-weight-bold text-white">{{ __('student') }}</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white active bg-gradient-primary" href="{{ route('home-student') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('home') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('timetable-student') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('timeTable') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('students.searchCourse') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">assignment</i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('register') }}</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages
                    </h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('student.edit') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('profile') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('reset') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">lock</i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('changePass') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"> <a href="{{ route('change-language', ['vi']) }}"><img
                                    height="25px" width="25px"
                                    src=" {{ asset('bower_components/bower_project1/img/vn.png') }}"></a>
                        </li>
                        <li class="breadcrumb-item text-sm"> <a href="{{ route('change-language', ['en']) }}"><img
                                    height="25px" width="25px"
                                    src=" {{ asset('bower_components/bower_project1/img/gb.png') }}"></a>
                        </li>
                    </ol>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group input-group-outline">
                        </div>
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{ route('logout') }}" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">{{ __('signout') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        @yield('content')
        </div>
    </main>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-icons py-2">settings</i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">{{ __('Material UI Configurator') }}</h5>
                    <p>{{ __('See our dashboard options.') }}</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">{{ __('Sidebar Colors') }}</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger"
                            onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">{{ __('Sidenav Type') }}</h6>
                    <p class="text-sm">{{ __('Choose between 2 different sidenav types.') }}</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark"
                        onclick="sidebarType(this)">{{ __('Dark') }}</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent"
                        onclick="sidebarType(this)">{{ __('Transparent') }}</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white"
                        onclick="sidebarType(this)">{{ __('White') }}</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">
                    {{ __('You can change the sidenav type just on desktop view.') }}</p>
                <!-- Navbar Fixed -->
                <div class="mt-3 d-flex">
                    <h6 class="mb-0">{{ __('Navbar Fixed') }}</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                            onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">{{ __('Light / Dark') }}</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                            onclick="darkMode(this)">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('bower_components/bower_project1/js/user/core/popper.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/js/user/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/js/user/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/js/user/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/js/user/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/js/user/popup.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script async defer src="{{ asset('bower_components/bower_project1/js/user/buttons/index.js') }}"></script>
    <script src="{{ asset('bower_components/bower_project1/js/user/material-dashboard.min.js?v=3.0.0') }}"></script>
</body>

</html>
