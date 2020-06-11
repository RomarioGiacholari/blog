<nav class="navbar navbar-inverse" style="background:black">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand {{ Request::is('/') ? 'active' : '' }}" href="{{ route('welcome') }}">#</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="{{ route('posts.index') }}" class="{{ Request::is('posts*') ? 'active' : '' }}">blog</a></li>
        <li><a href="{{ route('photos') }}" class="{{ Request::is('all-photos*') ? 'active' : '' }}">photos</a></li>
        <li><a href="{{ route('resume') }}" class="{{ Request::is('resume') ? 'active' : '' }}">resume</a></li>
        <li><a href="{{ route('coffee.index') }}" class="{{ Request::is('coffee*') ? 'active' : '' }}">coffee</a></li>
        <li><a href="{{ route('about.index') }}" class="{{ Request::is('about*') ? 'active' : '' }}">about</a></li>
        <li><a href="{{ route('contact.create') }}" class="{{ Request::is('contact*') ? 'active' : '' }}">contact</a></li>
    </ul>
      <ul class="nav navbar-nav navbar-right">
        @auth
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('dashboard.index') }}">dashboard</a></li>
                <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); 
                        document.getElementById('logout-form').submit();"
                        >
                        logout
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </ul>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>