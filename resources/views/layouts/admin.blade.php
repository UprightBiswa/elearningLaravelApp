<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    @yield('css')







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
        @include('layouts.inc.admin.navber')


        @include('layouts.inc.admin.sidebar')



        @yield('content')




        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="../index.htm" target="_blank">DexignLab</a>2020</p>
            </div>
        </div>


    </div>
    
    <script src="{{ asset('admin/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('admin/js/custom.min.js') }}"></script>
    <script src="{{ asset('admin/js/dlabnav-init.js') }}"></script>

    @yield('js')

    <!-- Svganimation scripts -->
    <script src="{{ asset('admin/vendor/svganimation/vivus.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/svganimation/svg.animation.js') }}"></script>
    <script src="{{ asset('admin/js/styleSwitcher.js') }}"></script>

</body>

</html>
