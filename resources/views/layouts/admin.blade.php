<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/bower_project1/css/admin/bootstrap.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bower_project1/css/admin/app.css') }}" />

    <!-- BEGIN: load jquery -->
    <script src="{{ asset('bower_components/bower_project1/js/admin/jquery.js') }}" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script src="{{ asset('bower_components/bower_project1/js/admin/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bower_components/bower_project1/js/admin/admin.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bower_components/chart.min/index.js') }}" type="text/javascript"></script>
</head>

<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="{{ asset('bower_components/bower_project1/img/livelogo.png') }}" alt="Logo" />
                </div>
                <div class="floatleft middle">

                </div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="{{ asset('bower_components/bower_project1/img/img-profile.jpg') }}"
                            alt="Profile Pic" />
                    </div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li><a href="{{ route('logout') }}">{{ __('Logout') }}</a></li>
                        </ul>
                    </div>
                    <a href="{{ route('change-language', ['en']) }}">{{ __('English') }} </a>
                    <a href="{{ route('change-language', ['vi']) }}">{{ __('Vietnamese') }}</a>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="{{ route('home') }}"><span>{{ __('Dashboard') }}</span></a>
                </li>
            </ul>
        </div>
        <div class="clear">
        </div>
        <div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                        <li><a class="menuitem">{{ __('Lecturer Option') }}</a>
                            <ul class="submenu">
                                <li><a href="{{ route('lecturers.create') }}">{{ __('Add Lecturer') }}</a> </li>
                                <li><a href="{{ route('lecturers.index') }}">{{ __('Lecturers List') }}</a> </li>
                                <li><a href="{{ route('lecturers.chart') }}">{{ __('chart') }}</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">{{ __('Student Option') }}</a>
                            <ul class="submenu">
                                <li><a href="{{ route('students.create') }}">{{ __('Add Student') }}</a> </li>
                                <li><a href="{{ route('students.index') }}">{{ __('Students List') }}</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">{{ __('Course Option') }}</a>
                            <ul class="submenu">
                                <li><a href="{{ route('courses.create') }}">{{ __('Add Course') }}</a> </li>
                                <li><a href="{{ route('courses.index') }}">{{ __('Courses List') }}</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @yield('content')
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">
        <p>
            &copy; Copyright <a href="http://trainingwithliveproject.com">Training with live project</a>. All Rights
            Reserved.
        </p>
    </div>
</body>

</html>
