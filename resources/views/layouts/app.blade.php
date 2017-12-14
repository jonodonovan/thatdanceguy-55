<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-10717073-21"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-10717073-21');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('script_header')

    @yield('style')

</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-lg-2">
                @include('partials.nav_public')
            </div>
            <div class="col-sm-9 col-lg-10">
                @yield('content')
            </div>
        </div>
    </div>
    <div id="app"></div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script_footer')

</body>
</html>
