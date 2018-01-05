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

    <link rel="apple-touch-icon" sizes="57x57" href="/theme/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/theme/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/theme/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/theme/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/theme/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/theme/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/theme/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/theme/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/theme/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/theme/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/theme/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/theme/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/theme/favicon-16x16.png">
    <link rel="manifest" href="/theme/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/theme/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <meta property="og:image" content="https://thatdanceguy.com/theme/Logo_white_320x320.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="320">
    <meta property="og:image:height" content="320">

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
