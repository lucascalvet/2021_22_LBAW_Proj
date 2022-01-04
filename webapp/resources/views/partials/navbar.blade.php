@php
$icon_size = 'fs-4';
$left_links = [
    'home' => ['title' => 'Home', 'icon' => 'bi bi-house-fill'],
    'notifications' => ['title' => 'Notifications', 'icon' => 'bi bi-bell-fill'],
    'search' => ['title' => 'Search', 'icon' => 'bi bi-search'],
];
$right_links = [
    'chat' => ['title' => 'Chat', 'icon' => 'bi bi-chat-fill'],
    'groups' => ['title' => 'Groups', 'icon' => 'bi bi-people-fill'],
];
@endphp

<nav class="navbar navbar-expand-sm navbar-dark bg-secondary py-0">
  <div class="container-fluid">
    <button class="order-first navbar-toggler my-2 fs-6" type="button" data-bs-toggle="collapse"
      data-bs-target=".multi-collapse" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse multi-collapse navbar-collapse" id="leftIcons">
      <ul class="container-fluid px-0 align-items-sm-center navbar-nav justify-content-sm-evenly">
        @foreach ($left_links as $page => $props)
          <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == $page ? 'active' : '' }}"
              {{ request()->is($page) ? 'aria-current="page"' : '' }} href="{{ route($page) }}">
              <i class="{{ $props['icon'] }} {{ $icon_size }}" aria-label="{{ $props['title'] }}"></i>
              <span class="d-sm-none">{{ $props['title'] }}</span>
            </a>
          </li>
        @endforeach
      </ul>
    </div>
    <a class="order-first flex-grow-1 flex-sm-grow-0 text-center order-sm-0 d-sm-block navbar-brand fs-3 fw-bold mx-2 py-0"
      href="{{ route('home') }}">Social UP</a>
    <div class="collapse multi-collapse navbar-collapse" id="rightIcons">
      <ul class="container-fluid px-0 align-items-sm-center navbar-nav justify-content-sm-evenly">
        @foreach ($right_links as $page => $props)
          <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == $page ? 'active' : '' }}"
              {{ request()->is($page) ? 'aria-current="page"' : '' }} href="{{ route($page) }}">
              <i class="{{ $props['icon'] }} {{ $icon_size }}" aria-label="{{ $props['title'] }}"></i>
              <span class="d-sm-none">{{ $props['title'] }}</span>
            </a>
          </li>
        @endforeach
        @auth
          <li class="nav-item d-flex align-items-center">
            <a class="nav-link d-flex align-items-center" href="{{ route('profile', ['user' => Auth::user()->id]) }}">
              <i class="bi bi-person-circle {{ $icon_size }}"></i>
              <span class="d-inline-block text-truncate" style="max-width: 10em;">&nbsp;{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown">
              <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownProfile"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              </button>
              <div class="dropdown-menu" style="right: 0; left: auto;" aria-labelledby="dropdownProfile">
                <a class="dropdown-item" href="{{ route('profile', ['user' => Auth::user()->id]) }}">Profile</a>
                <a class="dropdown-item" href="{{ route('profile.edit', ['user' => Auth::user()->id]) }}">Edit
                  Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                  {{ csrf_field() }}
                </form>

              </div>
            </div>
          </li>
        @endauth
        @guest
          {{-- Button for non-authenticated --}}
          <li class="nav-item  d-flex align-items-center">
            <a class="nav-link d-flex align-items-center" href='{{ route('login') }}'>
              <i class="bi bi-person-circle {{ $icon_size }}"></i>
              <span class="">&nbsp;Guest</span>
            </a>
            <div class="dropdown">
              <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownProfile"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              </button>
              <div class="dropdown-menu" style="right: 0; left: auto;" aria-labelledby="dropdownProfile">
                <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                <a class="dropdown-item" href="{{ route('register') }}">Register</a>
              </div>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
