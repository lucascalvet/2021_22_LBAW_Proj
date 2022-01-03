@php
/* use App\Models\TextContent;
use App\Models\MediaContent;
use App\Models\Content; */

$icon_size = 'fs-5';

$profile_pic = 'img/profile_pic.png';
$username = 'John Doe';
$time = '10 days ago';
$title = 'Wari(El)o(n)';
$n_hearts = '3000';
$n_comments = '100';
$n_shares = '100';
$description = 'Description: Elon vestido de Wario porque reasons.';
$video = '';
$image = 'img/cont_elon.jpg';
$example_video = 'vid/ex.mp4';
$example_image = 'img/cont_elon.jpg';

$link_edit = route('textcontent.edit', ['id' => $content->id]);
$link_view = route('content.show', ['id' => $content->id]);
@endphp


<div class="card text-black p-0" style="width: 19em; height: 30em; overflow-y: auto;">
  <div class="card-header">
    <div class="d-flex flex-row justify-content-between">
      <div class="d-sm-block">
        <img src="{{ asset($profile_pic) }}" class="rounded-circle align-self-center" style="width: 3em; height: 3em;"
          alt="Profile Picture" />
        <span class="align-self-centre" style="">{{ $content->creator->name }}</span>
      </div>

      <div class="d-sm-flex align-self-center">
        <a href="{{ $link_view }}" class="mx-1">
          <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-arrows-angle-expand {{ $icon_size }}"></i>
          </button>
        </a>
        <div class="dropdown">
          <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownPost"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-three-dots {{ $icon_size }}"></i>
          </button>
          <div class="dropdown-menu" style="right: 0; left: auto;" aria-labelledby="dropdownPost">
            @if (Auth::user() == $content->creator)
              <a class="dropdown-item" href="{{ $link_edit }}">Edit Post</a>
              <a class="dropdown-item" href="#">Delete Post</a>
            @endif
            <a class="dropdown-item" href="#">Other Options</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="text-center">
      <h5>Title</h5>
    </div>
    @if ($content->contentable instanceof App\Models\MediaContent)
      <div class="row justify-content-center pt-3">
        @if ($content->contentable->media_contentable instanceof App\Models\Video)
          <video src="{{ asset($content->contentable->media) }}" class="align-self-centre" controls
            style="max-width: 18em; max-height: 30em;"></video>
        @elseif ($content->contentable->media_contentable instanceof App\Models\Image)
          <img src="{{ asset($content->contentable->media) }}" class="align-self-centre"
            style="max-width: 20em; max-height: 30em;"></img>
        @endif
      </div>
    @else
    @if ($content->contentable instanceof App\Models\TextContent)
      <p class="card-text pt-3" style="max-width: 20em;">{{ $content->contentable->post_text }}</p>
    @endif
    @endif
    <div class="row pt-3">
      <div class="col-3">
        <div class="row justify-content-center">
          <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-chat-left-text {{ $icon_size }}"></i>
          </button>
          <span class="text-center">{{ $n_comments }}</span>
        </div>
      </div>
      <div class="col-6">
        <div class="row justify-content-center">
          <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-heart {{ $icon_size }}"></i>
          </button>
          <span class="text-center">{{ $n_hearts }}</span>
        </div>
      </div>
      <div class="col-3">
        <div class="row justify-content-center">
          <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-share {{ $icon_size }}"></i>
          </button>
          <span class="text-center">{{ $n_shares }}</span>
        </div>
      </div>
    </div>
    @if ($content->contentable instanceof App\Models\MediaContent)
      <p class="card-text" style="max-width: 20em;">{{ $content->contentable->description }}</p>
    @endif
  </div>
</div>
