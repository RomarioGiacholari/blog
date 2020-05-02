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
        <div class="text-center top-links">
            <a href="https://www.instagram.com/am.giacholari/"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
            <a href="https://github.com/RomarioGiacholari"><i class="fa fa-github fa-2x" aria-hidden="true"></i></a>
            <a href="https://uk.linkedin.com/in/romario-giacholari-71130b11b"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a>
            <span class="font-size-16"> | &copy;2020 Giacholari.</span>
            <a href="{{ route('privacy-policy.index') }}" class="font-size-16"><u>privacy</u></a>
        </div>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ route('welcome') }}">#</a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('welcome') }}">home</a></li>
                        <li class="{{ Request::is('posts*') ? 'active' : '' }}"><a href="{{ route('posts.index') }}">blog</a></li>
                        <li class="{{ Request::is('all-photos*') ? 'active' : '' }}"><a href="{{ route('photos') }}">photos</a></li>
                        <li class="{{ Request::is('resume') ? 'active' : '' }}"><a href="{{ route('resume') }}">resume</a></li>
                        <li class="{{ Request::is('coffee*') ? 'active' : '' }}"><a href="{{ route('coffee.index') }}">coffee</a></li>
                        <li class="{{ Request::is('contact*') ? 'active' : '' }}"><a href="{{ route('contact.create') }}">contact</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @auth
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('dashboard.index') }}">dashboard</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
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
