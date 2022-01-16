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
  <button class="order-first navbar-toggler m-2 fs-6 align-self-start" type="button" data-bs-toggle="collapse"
    data-bs-target=".multi-collapse" aria-controls="navbarSupportedContent" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="row flex-grow-1 align-items-center m-0">
    <div class="col-12 col-sm-5 order-2 order-sm-1 collapse multi-collapse navbar-collapse">
      <ul class="align-items-center navbar-nav justify-content-evenly flex-grow-1" id="leftIcons">
        @foreach ($left_links as $page => $props)
          <li class="nav-item">
            <a class="nav-link{{ Route::currentRouteName() == $page ? ' active' : '' }}"
              {{ Route::currentRouteName() == $page ? 'aria-current=page' : '' }} href="{{ route($page) }}">
              <i class="{{ $props['icon'] }} {{ $icon_size }}" aria-label="{{ $props['title'] }}"></i>
              <span class="d-sm-none">{{ $props['title'] }}</span>
            </a>
          </li>
        @endforeach
      </ul>
    </div>
    <div class="col-12 col-sm-2 order-1 order-sm-2 d-flex justify-content-center">
      <a class="order-sm-0 d-sm-block navbar-brand fs-3 fw-bold mx-2 nav-link" href="{{ route('home') }}">Social
        UP</a>
    </div>
    <div class="col-12 col-sm-5 order-last collapse multi-collapse navbar-collapse">
      <ul class="align-items-center navbar-nav justify-content-evenly flex-grow-1" id="rightIcons">
        @foreach ($right_links as $page => $props)
          <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == $page ? 'active' : '' }}"
              {{ Route::currentRouteName() == $page ? 'aria-current="page"' : '' }} href="{{ route($page) }}">
              <i class="{{ $props['icon'] }} {{ $icon_size }}" aria-label="{{ $props['title'] }}"></i>
              <span class="d-sm-none">{{ $props['title'] }}</span>
            </a>
          </li>
        @endforeach
        <li class="nav-item d-flex align-items-center">
          @auth
            <div class="btn-group">
              <a role="button" class="btn btn-light py-0 d-flex align-items-center"
                href="{{ route('profile', ['user' => Auth::user()->id]) }}">
                <i class="text-secondary bi bi-person-circle {{ $icon_size }}"></i>
                <span class="text-secondary text-truncate"
                  style="max-width: 10em;">&nbsp;{{ Auth::user()->name }}</span>
              </a>
              <button type="button" class="text-secondary btn btn-light dropdown-toggle dropdown-toggle-split"
                id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownProfile">
                <li><a class="dropdown-item" href="{{ route('profile', ['user' => Auth::user()->id]) }}">Profile</a>
                </li>
                <li><a class="dropdown-item" href="{{ route('profile.edit', ['user' => Auth::user()->id]) }}">Edit
                    Profile</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
              </ul>
            </div>
          @endauth
          @guest
            <div class="btn-group">
              <a role="button" class="btn btn-light py-0 d-flex align-items-center" href="{{ route('login') }}">
                <i class="text-secondary bi bi-person-circle {{ $icon_size }}"></i>
                <span class="text-secondary text-truncate" style="max-width: 10em;">&nbsp;Guest</span>
              </a>
              <button type="button" class="text-secondary btn btn-light dropdown-toggle dropdown-toggle-split"
                id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownProfile">
                <li><a class="dropdown-item" href="{{ route('login') }}">Login</a>
                </li>
                <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
              </ul>
            </div>
          @endguest
        </li>
      </ul>
    </div>
  </div>
</nav>
