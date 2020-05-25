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

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://assets.giacholari.com/css/blog/app.css" type="text/css">
</head>
<body>
    <div id="app">
        <div class="text-center social">
            <a href="tel:+447587735380" title="call"><i class="fa fa-phone-square fa-2x"></i></a>
            <a href="mailto:giacholari@gmail.com" title="email"><i class="fa fa-envelope fa-2x"></i></a>
            <a href="https://www.instagram.com/am.giacholari/" title="instagram"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
            <a href="https://github.com/RomarioGiacholari" title="github"><i class="fa fa-github fa-2x" aria-hidden="true"></i></a>
            <a href="https://uk.linkedin.com/in/romario-giacholari-71130b11b" title="linkedin"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a>
            <a href="{{ route('privacy-policy.index') }}">&copy; giacholari</a>
            <clock></clock>
        </div>
        <nav class="nav">
            <div class="text-center">
                <a href="{{ route('welcome') }}" class="{{ Request::is('/') ? 'active' : '' }}">home</a>
                <a href="{{ route('posts.index') }}" class="{{ Request::is('posts*') ? 'active' : '' }}">blog</a>
                <a href="{{ route('photos') }}" class="{{ Request::is('all-photos*') ? 'active' : '' }}">photos</a>
                <a href="{{ route('resume') }}" class="{{ Request::is('resume') ? 'active' : '' }}">resume</a>
                <a href="{{ route('coffee.index') }}" class="{{ Request::is('coffee*') ? 'active' : '' }}">coffee</a>
                <a href="{{ route('about.index') }}" class="{{ Request::is('about*') ? 'active' : '' }}">about</a>
                <a href="{{ route('contact.create') }}" class="{{ Request::is('contact*') ? 'active' : '' }}">contact</a>
                @auth
                <a href="{{ route('dashboard.index') }}" class="{{ Request::is('dashboard*') ? 'active' : '' }}">dashboard</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                @endauth
            </div>
        </nav>

        @yield('content')
        <privacy-modal></privacy-modal>
    </div>
    <script src="https://assets.giacholari.com/js/blog/app.js" defer></script>
    @yield('scripts')
</body>
</html>
