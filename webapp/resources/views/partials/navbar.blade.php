@php
$icon_size = 'fs-4';
$left_links = [
    "/" => ["title" => "Home", "icon" => "bi bi-house-fill"],
    "/notifications" => ["title" => "Notifications", "icon" => "bi bi-bell-fill"],
    "search" => ["title" => "Search", "icon" => "bi bi-search"]
];
$right_links = [
    "chat" => ["title" => "Chat", "icon" => "bi bi-chat-fill"],
    "groups" => ["title" => "Groups", "icon" => "bi bi-people-fill"]
];
@endphp

<nav class="navbar navbar-expand-sm navbar-dark bg-secondary py-0">
    <div class="container-fluid">
        <button class="order-first navbar-toggler my-2 fs-6" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse multi-collapse navbar-collapse" id="leftIcons">
            <ul class="container-fluid px-0 align-items-sm-center navbar-nav justify-content-sm-evenly">
                @foreach ($left_links as $link => $props)
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is($link)) ? 'active' : '' }}" {{ (request()->is($link)) ? 'aria-current="page"' : '' }} href="{{ URL::to($link) }}">
                        <i class="{{ $props["icon"] }} {{ $icon_size }}" aria-label="{{ $props["title"] }}"></i>
                        <span class="d-sm-none">{{ $props["title"] }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <a class="order-first flex-grow-1 flex-sm-grow-0 text-center order-sm-0 d-sm-block navbar-brand fs-3 fw-bold mx-2 py-0" href="{{ URL::to('/') }}">Social UP</a>
        <div class="collapse multi-collapse navbar-collapse" id="rightIcons">
            <ul class="container-fluid px-0 align-items-sm-center navbar-nav justify-content-sm-evenly">
                @foreach ($right_links as $link => $props)
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is($link)) ? 'active' : '' }}" {{ (request()->is($link)) ? 'aria-current="page"' : '' }} href="{{ URL::to($link) }}">
                        <i class="{{ $props["icon"] }} {{ $icon_size }}" aria-label="{{ $props["title"] }}"></i>
                        <span class="d-sm-none">{{ $props["title"] }}</span>
                    </a>
                </li>
                @endforeach
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ URL::to('user') }}"> <!-- TODO: Update link -->
                        <i class="bi bi-person-circle {{ $icon_size }}"></i>
                        <span class="">&nbsp;{{ Auth::user()->name }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
