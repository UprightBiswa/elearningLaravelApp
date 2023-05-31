<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('student/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('student/vendor/jqvmap/css/jqvmap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('student/vendor/chartist/css/chartist.min.css') }}">
	<link rel="stylesheet" href="{{ asset('student/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('student/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('student/css/skin-2.css') }}">





</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <div id="main-wrapper">



        <!--**********************************
            Nav header start
        ***********************************-->
        @include('layouts.inc.student.navber')


        @include('layouts.inc.student.sidebar')


        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>


        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="../index.htm" target="_blank">DexignLab</a>2020</p>
            </div>
        </div>


    </div>





    <script src="{{ asset('student/vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('student/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('student/js/custom.min.js') }}"></script>
	<script src="{{ asset('student/js/dlabnav-init.js') }}"></script>

    <!-- Chart ChartJS plugin files -->
    <script src="{{ asset('student/vendor/chart.js/Chart.bundle.min.js') }}"></script>

	<!-- Chart piety plugin files -->
    <script src="{{ asset('student/vendor/peity/jquery.peity.min.js') }}"></script>

	<!-- Chart sparkline plugin files -->
    <script src="{{ asset('student/vendor/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

		<!-- Demo scripts -->
    <script src="{{ asset('student/js/dashboard/dashboard-3.js') }}"></script>

	<!-- Svganimation scripts -->
    <script src="{{ asset('student/vendor/svganimation/vivus.min.js') }}"></script>
    <script src="{{ asset('student/vendor/svganimation/svg.animation.js') }}"></script>
    <script src="{{ asset('student/js/styleSwitcher.js') }}"></script>

</body>

</html>
