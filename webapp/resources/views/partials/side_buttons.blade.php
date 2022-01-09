@php
$icon_size = 'fs-3';
@endphp

<nav class="d-flex flex-column">
    <div class="d-flex flex-row my-3">
        <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-bar-chart {{ $icon_size }}"></i>
        </button>
        <span class="d-none d-md-block d-lg-none align-self-center ms-3">Ranking</span>
    </div>
    <div class="d-flex flex-row my-3">
        <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-controller {{ $icon_size }}"></i>
        </button>
        <span class="d-none d-md-block d-lg-none align-self-center ms-3">Games</span>
    </div>
    <div class="d-flex flex-row my-3">
        <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-chat-dots {{ $icon_size }}"></i>
        </button>
        <span class="d-none d-md-block d-lg-none align-self-center ms-3">Messages</span>
    </div>
    <div class="d-flex flex-row my-3">
        <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-list {{ $icon_size }}"></i>
        </button>
        <span class="d-none d-md-block d-lg-none align-self-center ms-3">Options</span>
    </div>
</nav>