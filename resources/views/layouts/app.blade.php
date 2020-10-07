<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Romario Giacholari">
    <meta property="og:site_name" content="Romario Giacholari">
    @yield('meta-tags')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Romario Giacholari | @yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" type="text/css">
    <link rel="stylesheet" href="https://assets.giacholari.com/css/blog/app.css" type="text/css">

    <!-- JavaScript App Settings -->
    <script defer>window.app = { cookieDomain: "{{ config('app.cookie_domain') }}" };</script>
</head>
<body>
    <div id="app">
        @include('components._social')
        @include('navbar.navbar')
        @yield('content')
        <privacy-modal></privacy-modal>
    </div>
    <script src="https://assets.giacholari.com/js/blog/app.js" defer></script>
    @yield('scripts')
</body>
</html>
