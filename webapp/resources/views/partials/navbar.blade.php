<header>
  <h1><a href="{{ url('/cards') }}">Social UP</a></h1>
  @if (Auth::check())
  <a class="button" href="{{ url('/logout') }}"> Logout </a> <span>{{ Auth::user()->name }}</span>
  @endif
</header>
