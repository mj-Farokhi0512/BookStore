<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--    <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    {{--    <title>{{ config('app.name', 'Laravel') }}</title> --}}

    <!-- Scripts -->
    {{-- @vite(['resources/css/bootstrap.min.css', 'resources/js/bootstrap.min.js', 'resources/css/swiper-bundle.min.css', 'resources/css/animate.css', 'resources/css/style_1.css', 'resources/css/custom.css']) --}}

    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome/css/regular.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome/css/solid.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_1.css') }}" />

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    @stack('head')
</head>

<body class="font-sans antialiased">
    @include('header')
    @yield('content')


    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!-- WOW JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- BOOTSTRAP MIN JS -->
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <!-- BOOTSTRAP SELECT MIN JS -->
    <script src="{{ asset('js/waypoints-min.js') }}"></script>
    <!-- WAYPOINTS JS -->
    <script src="{{ asset('js/counterup.min.js') }}"></script>
    <!-- COUNTERUP JS -->
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <!-- SWIPER JS -->
    <script src="{{ asset('js/dz.carousel.js') }}"></script>
    <!-- DZ CAROUSEL JS -->
    <script src="{{ asset('js/dz.ajax_1.js') }}"></script>
    <!-- AJAX -->
    {{-- <script src="{{asset('js/custom_2.js')}}"></script> --}}
    @stack('scripts')
</body>

</html>
