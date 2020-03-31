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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">    
</head>
<body>
    <div id="app">
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
                    <a class="navbar-brand" href="{{ route('photos.show', ['identifier' => 'me-posing.jpg']) }}">
                        <img class="img-circle" src="{{ asset('me-posing.jpg') }}" height="30" width="30" title="Romario Giacholari" alt="Romario Giacholari" />
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('welcome') }}">home</a></li>
                        <li class="{{ Request::is('posts*') ? 'active' : '' }}"><a href="{{ route('posts.index') }}">blog</a></li>
                        <li class="{{ Request::is('all-photos*') ? 'active' : '' }}"><a href="{{ route('photos') }}">photos</a></li>
                        <li class="{{ Request::is('resume') ? 'active' : '' }}"><a href="{{ route('resume') }}">resume</a></li>
                        <!-- <li class="{{ Request::is('podcast*') ? 'active' : '' }}"><a href="{{ route('episodes.index') }}">podcast</a></li> -->
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
                                    <li><a href="/home/posts">posts</a></li>
                                    <li><a href="/home/episodes">episodes</a></li>
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
        <div class="footer-links text-center">
            <span>fine print: <a href="{{ route('privacy-policy.index') }}">privacy</a></span>
            <span>&copy;2020 Giacholari.</span>
            <span id="dateElement"></span>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')
</body>
</html>
