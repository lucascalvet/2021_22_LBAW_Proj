@php
$icon_size = 'fs-5';
$font_size = 'fs-6';

$n_comments = $content->comment_count();

$user = Auth::user();
$link_edit = route('content.edit', ['id' => $content->id]);
$link_view = route('content.show', ['id' => $content->id]);
$link_remove = route('content.remove', ['id' => $content->id]);

$dropdownid = "dropdownPost" . $content->id;
@endphp

<div class="card text-black p-0" style="width: 19em; height: 30em; overflow-y: auto;">
  <div class="card-header">
    <div class="d-flex flex-row align-items-center">

      <div class="d-block">
        <img src="{{ asset($content->creator->profile_picture) }}" class="rounded-circle align-self-center" style="width: 3em; height: 3em;" alt="Profile Picture" />
      </div>
      <div class="d-inline-block text-truncate">
        <a href="{{ route('profile', ['user' => $content->creator->id]) }}"><span class="mx-3">{{ $content->creator->username }}</span></a>
      </div>
      <div class="d-flex flex-row align-self-center ms-auto">
        <a href="{{ $link_view }}" class="btn btn-secondary ms-2">
            <i class="bi bi-arrows-angle-expand {{ $icon_size }}"></i>
        </a>
        @if (Auth::check() && (Auth::user()->can('update', $content) || Auth::user()->can('deleteFromGroup', $content)))
        <div class="dropdown">
          <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split ms-2" id="{{ $dropdownid }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-three-dots {{ $icon_size }}"></i>
          </button>

          <div class="dropdown-menu" aria-labelledby="{{ $dropdownid }}">

            @if (Auth::check() && Auth::user()->can('update', $content))
            <a class="dropdown-item" href="{{ $link_edit }}">Edit Post</a>
            @endif
            @if (Auth::check() && Auth::user()->can('delete', $content))
            <form method="POST" action="{{ route('content.destroy', $content) }}">
              @csrf
              @method('DELETE')
              <button class="dropdown-item" type="submit">Delete Post</button>
            </form>
            @endif
            @if (Auth::check() && (Auth::user()->can('update', $content) || Auth::user()->can('delete', $content)) && Auth::user()->can('deleteFromGroup', $content))
            <div class="dropdown-divider"></div>
            @endif
            @if (Auth::user()->can('deleteFromGroup', $content))
            <form method="POST" action="{{ $link_remove }}">
              @csrf
              @method('PATCH')
              <button class="dropdown-item" type="submit">Remove
                from Group</button>
            </form>
            @endif
          </div>

        </div>
        @endif
      </div>
    </div>
  </div>
  <div class="card-header text-secondary">
    {{ $content->publishing_date->format('D, Y-m-d H:i:s') }}
    @if ($content->contentable instanceof App\Models\TextContent && !$content->contentable->isRoot())
    <br>
    In response to <a class="text-truncate" href="{{ route('content.show', ['id' => $content->contentable->parent->first()->id_content]) }}">{{ $content->contentable->parent->first()->content->creator->username}}</a>
    @endif
  </div>
  <div class="card-body d-flex flex-column">
    <div class="mb-auto">
      @if ($content->contentable instanceof App\Models\MediaContent)
      <div class="row justify-content-center py-3">
        @if ($content->contentable->media_contentable instanceof App\Models\Video)
        <video src="{{ asset($content->contentable->media) }}" class="align-self-centre" controls style="max-width: 18em; max-height: 30em;"></video>
        @elseif ($content->contentable->media_contentable instanceof App\Models\Image)
        <img src="{{ asset($content->contentable->media) }}" alt="{{ $content->contentable->alt_text }}" class="align-self-centre" style="max-width: 20em; max-height: 30em;" />
        @endif
      </div>
      @endif
      <p class="card-text pt-3{{ $font_size }}" style="max-width: 20em;">
        @if ($content->contentable instanceof App\Models\MediaContent)
        @if ($content->contentable->media_contentable instanceof App\Models\Video)
        {{ $content->contentable->media_contentable->title }}
        @elseif ($content->contentable->media_contentable instanceof App\Models\Image)
        {{ $content->contentable->description }}
        @endif
        @elseif ($content->contentable instanceof App\Models\TextContent)
        {{ $content->contentable->post_text }}
        @endif
      </p>
    </div>
    <div class="row pt-3">
      <div class="col-3">
        <div class="row justify-content-center">
          <a class="btn btn-secondary w-auto h-auto" href="{{ route('content.show', ['id' => $content->id, '#comments']) }}" role="button">
            <i class="bi bi-chat-left-text {{ $icon_size }}"></i>
          </a>
          <span class="text-center">{{ $n_comments }}</span>
        </div>
      </div>
      <div class="col-6">
        <div class="row justify-content-center">
          @if (Auth::user())
          <button id="button-content-like-{{ $content->id }}" type="button" class="btn btn-secondary button-content-like" style="width: auto; height: auto;">
            @if (\App\Models\Like::where('id_user', Auth::user()->id)->where('id_content', $content->id)->count() != 0)
            <i style="color: red;" class="bi bi-heart-fill fs-5"></i>
            @else
            <i style="color: red;" class="bi bi-heart fs-5"></i>
            @endif
            @else
            <button disabled id="button-content-like-{{ $content->id }}" type="button" class="btn btn-secondary button-content-like" style="width: auto; height: auto;">
              <i style="color: red;" class="bi bi-heart fs-5"></i>
              @endif
            </button>
            <span id="s-hearts-count-{{ $content->id }}" class="text-center">{{ $content->numberOfLikes() }}</span>
        </div>
      </div>
      <div class="col-3">
        <div class="row justify-content-center">
          <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-share {{ $icon_size }}"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  @if ($content->id_group != null && $show_group)
  <div class="card-footer text-center">
    @ <a href="{{ route('group.show', ['id' => $content->id_group]) }}">
      {{ App\Models\Group::find($content->id_group)->name }}</a>
  </div>

  @endif

</div>