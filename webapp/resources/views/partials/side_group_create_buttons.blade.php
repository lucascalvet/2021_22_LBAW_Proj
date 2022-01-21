@php
$icon_size = 'fs-3';
$link_create_text = route('textcontent.make', ['id_group' => $group->id]);
$link_create_media = route('mediacontent.make', ['id_group' => $group->id]);
@endphp

<nav class="d-flex flex-column">
    <div class="d-flex flex-row my-3">
        <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-chat-dots {{ $icon_size }}"></i>
        </button>
        <span class="d-none d-md-block d-lg-none align-self-center ms-3">Messages</span>
    </div>
    @if($user != null)
    @if($group->members->contains($user))
    <div class="d-flex flex-row my-3">
        <a class="btn btn-secondary" href="{{ $link_create_text }}">
            <i class="bi bi-pencil-square {{ $icon_size }}"></i>
        </a>
        <span class="d-none d-md-block d-lg-none align-self-center ms-3">Create Text Content</span>
    </div>
    <div class="d-flex flex-row my-3">
        <a class="btn btn-secondary" href="{{ $link_create_media }}">
                <i class="bi bi-file-earmark-richtext {{ $icon_size }}"></i>
        </a>
        <span class="d-none d-md-block d-lg-none align-self-center ms-3">Create Media Content</span>
    </div>
    @if($group->moderators->contains($user))
    <div class="d-flex flex-row my-3">
        <form method="POST" action="{{ route('group.mod.leave', ['id' => $group->id, 'user' => $user->id]) }}">
            @csrf
            <button type="submit" class="btn btn-secondary" style="width: auto; height: auto;">
                <i class="bi bi-arrow-down-square {{ $icon_size }}"></i>
            </button>
        </form>
        <span class="d-none d-md-block align-self-center ms-3">Quit Moderation</span>
    </div>
    @endif
    <div class="d-flex flex-row my-3">
        <form method="POST" action="{{ route('group.member.leave', ['id' => $group->id, 'user' => $user->id]) }}">
            @csrf
            <button type="submit" class="btn btn-secondary" style="width: auto; height: auto;">
                <i class="bi bi-x-circle {{ $icon_size }}"></i>
            </button>
        </form>
        <span class="d-none d-md-block align-self-center ms-3">Leave Group</span>
    </div>
    @else
    <div class="d-flex flex-row my-3">
        <form method="POST" action="{{ route('group.member.join', ['id' => $group->id, 'user' => $user->id]) }}">
            @csrf
            <button type="submit" class="btn btn-secondary" style="width: auto; height: auto;">
                <i class="bi bi-box-arrow-in-right {{ $icon_size }}"></i>
            </button>
        </form>
        <span class="d-none d-md-block align-self-center ms-3">Join Group</span>
    </div>
    @endif
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