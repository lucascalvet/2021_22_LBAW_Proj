@php
$icon_size = 'fs-3';
$link_create_group = route('group.make');
@endphp

<nav class="d-flex flex-column">
    <div class="d-flex flex-row my-3">
        <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-chat-dots {{ $icon_size }}"></i>
        </button>
        <span class="d-none d-md-block align-self-center ms-3">Messages</span>
    </div>
    <div class="d-flex flex-row my-3">
        <a href="{{ $link_create_group }}">
            <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                <i class="bi bi-plus-circle {{ $icon_size }}"></i>
            </button>
        </a>
        <span class="d-none d-md-block align-self-center ms-3">Create Group</span>
    </div>
    <div class="d-flex flex-row my-3">
        <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-list {{ $icon_size }}"></i>
        </button>
        <span class="d-none d-md-block align-self-center ms-3">Options</span>
    </div>
</nav>