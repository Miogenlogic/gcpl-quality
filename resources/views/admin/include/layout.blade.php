
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="QMS Dashboard">
    <meta name="author" content="rK">
    <title>Quality Management System Dashboard - Gainwell</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{URL::asset('public/assets/img/brand/favicon.png?v=1.1.0')}}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/assets/vendor/nucleo/css/nucleo.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <!-- Page plugins -->

    <link rel="stylesheet" href="{{URL::asset('public/assets/vendor/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/assets/vendor/quill/dist/quill.core.css')}}">
    <!-- Argon CSS -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/assets/css/main-style.css?v=1.1.0')}}">
<style>
        .testno{
            border: solid 1px red;
        }
    </style>

    @yield('after_styles')
</head>


<body>
    @include('admin.include.sidebar')
    <div class="main-content" id="panel">

        @include('admin.include.header')

        <div class="header bg-primary pb-6">
            @yield('head')

        </div>

        <div class="container-fluid mt--6">
            @yield('body')

            @include('admin.include.footer')

        </div>
    </div>

    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{URL::asset('public/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/js-cookie/js.cookie.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/chart.js/dist/Chart.extension.js')}}"></script>
    <!-- Argon JS -->
    <script src="{{URL::asset('public/assets/js/main.js?v=1.1.0')}}"></script>
    <!-- Demo JS - remove this in your project -->
    <script src="{{URL::asset('public/assets/js/demo.min.js')}}"></script>

    @yield('after_script')

</body>

</html>


