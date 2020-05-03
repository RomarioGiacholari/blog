<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Romario Giacholari">
    <meta name="description" content="Personal website of Romario Giacholari. Web Developer and Student in Birmingham, UK.">
    <meta name="keywords" content="HTML,CSS,JavaScript,PHP,Laravel,Vue.js,Romario Giacholari">
    <meta property="og:site_name" content="Romario Giacholari">
    <meta property="og:title" content="Romario Giacholari">
    <meta property="og:description" content="Personal website of Romario Giacholari. Web Developer and Student in Birmingham, UK.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://giacholari.com">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Romario Giacholari | @yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    @if(app()->env == 'local')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
    @else
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}" type="text/css">
    @endif
</head>
<body>
    <div id="app">
        <div class="text-center social">
                <a href="https://www.instagram.com/am.giacholari/"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
                <a href="https://github.com/RomarioGiacholari"><i class="fa fa-github fa-2x" aria-hidden="true"></i></a>
                <a href="https://uk.linkedin.com/in/romario-giacholari-71130b11b"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a>
        </div>
        <nav class="nav">
            <div class="text-left">
                <a href="{{ route('welcome') }}"        class="{{ Request::is('/') ? 'active' : '' }}"><u>home</u></a>
                <a href="{{ route('posts.index') }}"    class="{{ Request::is('posts*') ? 'active' : '' }}"><u>blog</u></a>
                <a href="{{ route('photos') }}"         class="{{ Request::is('all-photos*') ? 'active' : '' }}"><u>photos</u></a>
                <a href="{{ route('resume') }}"         class="{{ Request::is('resume') ? 'active' : '' }}"><u>resume</u></a>
                <a href="{{ route('coffee.index') }}"   class="{{ Request::is('coffee*') ? 'active' : '' }}"><u>coffee</u></a>
                <a href="{{ route('about.index') }}"    class="{{ Request::is('about*') ? 'active' : '' }}"><u>about</u></a>
                <a href="{{ route('contact.create') }}" class="{{ Request::is('contact*') ? 'active' : '' }}"><u>contact</u></a>
                @auth
                <a href="{{ route('dashboard.index') }}" class="{{ Request::is('dashboard*') ? 'active' : '' }}"><u>dashboard</u></a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><u>logout</u></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                @endauth
            </div>
        </nav>

        @yield('content')
    </div>
    @if(app()->env == 'local')
    <script src="{{ asset('js/app.js') }}" defer></script>
    @else
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    @endif
    @yield('scripts')
</body>
</html>
