@php
/* use App\Models\TextContent;
use App\Models\MediaContent;
use App\Models\Content; */

$icon_size = 'fs-5';
$font_size = 'fs-6';

$profile_pic = 'img/profile_pic.png';
$username = 'John Doe';
$time = '10 days ago';
$title = 'Wari(El)o(n)';
$n_hearts = '3000';
$n_comments = $content->comment_count();
$description = 'Description: Elon vestido de Wario porque reasons.';
$video = '';
$image = 'img/cont_elon.jpg';
$example_video = 'vid/ex.mp4';
$example_image = 'img/cont_elon.jpg';

$link_edit = route('content.edit', ['id' => $content->id]);
$link_view = route('content.show', ['id' => $content->id]);
@endphp

<div class="card text-black p-0" style="width: 19em; height: 30em; overflow-y: auto;">
  <div class="card-header">
    <div class="d-flex flex-row justify-content-between">
      <div class="d-block">
        <img src="{{ asset($profile_pic) }}" class="rounded-circle align-self-center" style="width: 3em; height: 3em;"
          alt="Profile Picture" />
      </div>
      <div class="d-block">
        <a href="{{ route('profile', ['user' => $content->creator->id]) }}"><span
            class="d-flex flex-column text-centre mx-3">{{ $content->creator->name }}</span></a>
      </div>

      <div class="d-flex flex-row align-self-center">
        <a href="{{ $link_view }}" class="mx-1">
          <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-arrows-angle-expand {{ $icon_size }}"></i>
          </button>
        </a>
        @if (Auth::check() && Auth::user()->can('update', $content))
          <div class="dropdown">
            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownPost"
              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bi bi-three-dots {{ $icon_size }}"></i>
            </button>

            <div class="dropdown-menu" style="right: 0; left: auto;" aria-labelledby="dropdownPost">

              <a class="dropdown-item" href="{{ $link_edit }}">Edit Post</a>
              <form method="POST" action="{{ route('content.destroy', $content) }}">
                @csrf
                @method('DELETE')
                <button class="dropdown-item" type="submit">Delete Post</button>
              </form>
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
      In response to <a class="text-truncate"
        href="{{ route('content.show', ['id' => $content->contentable->parent->first()->id_content]) }}">{{ $content->contentable->parent->first()->content->creator->name }}</a>
    @endif
  </div>
  <div class="card-body d-flex flex-column">
    <div class="mb-auto">
      @if ($content->contentable instanceof App\Models\MediaContent)
        <div class="row justify-content-center py-3">
          @if ($content->contentable->media_contentable instanceof App\Models\Video)
            <video src="{{ asset($content->contentable->media) }}" class="align-self-centre" controls
              style="max-width: 18em; max-height: 30em;"></video>
          @elseif ($content->contentable->media_contentable instanceof App\Models\Image)
            <img src="{{ asset($content->contentable->media) }}" class="align-self-centre"
              style="max-width: 20em; max-height: 30em;" />
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
          <a class="btn btn-secondary w-auto h-auto"
            href="{{ route('content.show', ['id' => $content->id, '#comments']) }}" role="button">
            <i class="bi bi-chat-left-text {{ $icon_size }}"></i>
          </a>
          <span class="text-center">{{ $n_comments }}</span>
        </div>
      </div>
      <div class="col-6">
        <div class="row justify-content-center">
          <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-heart {{ $icon_size }}"></i>
          </button>
          <span class="text-center">{{ $n_hearts }}</span>
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
</div>
