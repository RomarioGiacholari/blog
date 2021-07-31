<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Romario Giacholari">
    <meta name="description" content="Personal website of Romario Giacholari. Web developer and student in England.">
    <meta name="keywords" content="HTML, CSS, JavaScript, C#, ASP.NET, PHP, JavaScript, Laravel, Vue.js, Romario Giacholari">

    <!-- Open Graph Meta Tags -->
    @yield('meta-tags', View::make('components._meta-tags'))

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Romario Giacholari | @yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" type="text/css">
    <link rel="stylesheet" href="https://assets.giacholari.com/css/blog/app.css" type="text/css">

    <!-- JavaScript App Settings -->
    <script defer>window.app = { cookieDomain: "{{ config('app.cookies.domain') }}" };</script>
</head>
<body>
    <div id="app" style="margin-bottom: 150px;">
        @include('components._social')
        @include('components._divider')
        @include('navbar.navbar')
        @include('components._noscript')
        @include('components._privacy', ['enabled' => config('app.privacy.enabled')])
        @yield('content')
    </div>
    <script defer src="https://assets.giacholari.com/js/blog/app.js"></script>
    <script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "24b18c23c53140d5a67de4a052d255cb"}'></script>
    @yield('scripts')
</body>
</html>
