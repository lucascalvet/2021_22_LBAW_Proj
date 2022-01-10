@php
$icon_size = 'fs-3';
$link_create_text = route('textcontent.make');
$link_create_media = route('mediacontent.make');
$link_join = route('group.member.join', ['id' => $group->id, 'user' => $user->id]);
$link_leave = route('group.member.leave', ['id' => $group->id, 'user' => $user->id]);
$link_demote = route('group.mod.leave', ['id' => $group->id, 'user' => $user->id]);
@endphp

<nav class="d-flex flex-column">
    <div class="d-flex flex-row my-3">
        <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-chat-dots {{ $icon_size }}"></i>
        </button>
        <span class="d-none d-md-block d-lg-none align-self-center ms-3">Messages</span>
    </div>
    @if($group->members->contains($user))
    <div class="d-flex flex-row my-3">
        <a href="{{ $link_create_text }}">
            <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                <i class="bi bi-pencil-square {{ $icon_size }}"></i>
            </button>
        </a>
        <span class="d-none d-md-block d-lg-none align-self-center ms-3">Create Text Content</span>
    </div>
    <div class="d-flex flex-row my-3">
        <a href="{{ $link_create_media }}">
            <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                <i class="bi bi-file-earmark-richtext {{ $icon_size }}"></i>
            </button>
        </a>
        <span class="d-none d-md-block d-lg-none align-self-center ms-3">Create Media Content</span>
    </div>
    @if($group->moderators->contains($user))
    <div class="d-flex flex-row my-3">
        <a href="{{ $link_demote }}">
            <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                <i class="bi bi-arrow-down-square {{ $icon_size }}"></i>
            </button>
        </a>
        <span class="d-none d-md-block align-self-center ms-3">Quit Moderation</span>
    </div>
    @endif
    <div class="d-flex flex-row my-3">
        <a href="{{ $link_leave }}">
            <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                <i class="bi bi-x-circle {{ $icon_size }}"></i>
            </button>
        </a>
        <span class="d-none d-md-block align-self-center ms-3">Leave Group</span>
    </div>
    @else
    <div class="d-flex flex-row my-3">
        <a href="{{ $link_join }}">
            <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                <i class="bi bi-box-arrow-in-right {{ $icon_size }}"></i>
            </button>
        </a>
        <span class="d-none d-md-block align-self-center ms-3">Join Group</span>
    </div>
    @endif
    <div class="dropright d-flex flex-row my-3">
        <button type="button" class="btn btn-secondary dropdown-toggle" id="dropdownMore" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-list {{ $icon_size }}"></i>
        </button>
        <span class="d-none d-md-block align-self-center ms-3">More</span>
        <div class="dropdown-menu" aria-labelledby="dropdownMore">
            <a class="dropdown-item" href="{{ route('about') }}">About</a>
            <a class="dropdown-item" href="{{ route('features') }}">Features</a>
            <a class="dropdown-item" href="{{ route('faq') }}">FAQ</a>
            <a class="dropdown-item" href="{{ route('contacts') }}">Contacts</a>
        </div>
    </div>
</nav>