@php
$icon_size = 'fs-4';
$left_links = [
['routes' => ['home'], 'title' => 'Home', 'icon' => 'bi bi-house-fill'],
['routes' => ['notifications'], 'title' => 'Notifications', 'icon' => 'bi bi-bell-fill'],
['routes' => ['search', 'search.content', 'search.users', 'search.groups'], 'title' => 'Search', 'icon' => 'bi bi-search'],
];
$right_links = [
['routes' => ['chat'], 'title' => 'Chat', 'icon' => 'bi bi-chat-fill'],
['routes' => ['groups'], 'title' => 'Groups', 'icon' => 'bi bi-people-fill'],
];
@endphp

<nav class="navbar navbar-expand-sm navbar-dark bg-secondary py-0">
  <button class="order-first navbar-toggler m-2 fs-6 align-self-start" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="row flex-grow-1 align-items-center m-0">
    <div class="col-12 col-sm-5 order-2 order-sm-1 collapse multi-collapse navbar-collapse">
      <ul class="align-items-center navbar-nav justify-content-evenly flex-grow-1" id="leftIcons">
        @foreach ($left_links as $props)
        <li class="nav-item">
          <a class="nav-link @if (in_array(Route::currentRouteName(), $props['routes'])) active" aria-current=page @else " @endif href=" {{ route($props['routes'][0]) }}">
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
        @foreach ($right_links as $props)
        <li class="nav-item">
          <a class="nav-link @if ($props['title'] == 'Chat') disabled @endif @if (in_array(Route::currentRouteName(), $props['routes'])) active" aria-current=page @else " @endif title=" {{ $props['title'] }}" href=" {{ route($props['routes'][0]) }}">
            <i class="{{ $props['icon'] }} {{ $icon_size }}" aria-label="{{ $props['title'] }}"></i>
            <span class="d-sm-none">{{ $props['title'] }}</span>
          </a>
        </li>
        @endforeach
        <li class="nav-item d-flex align-items-center">
          @auth
          <div class="btn-group">
            <a role="button" class="btn btn-secondary py-0 d-flex align-items-center" href="{{ route('profile', ['user' => Auth::user()->id]) }}">
              <i class="bi bi-person-circle {{ $icon_size }}"></i>
              <span class="text-truncate" style="max-width: 10em;">&nbsp;{{ Auth::user()->username }}</span>
            </a>
            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
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
              <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item" type="submit">Logout</button>
              </form>
              </li>
            </ul>
          </div>
          @endauth
          @guest
          <div class="btn-group">
            <a role="button" class="btn btn-secondary py-0 d-flex align-items-center" href="{{ route('login') }}">
              <i class="bi bi-person-circle {{ $icon_size }}"></i>
              <span class="text-truncate" style="max-width: 10em;">&nbsp;Guest</span>
            </a>
            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
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