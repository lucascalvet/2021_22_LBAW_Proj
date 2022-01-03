@extends('layouts.app')

@php
$icon_size = 'fs-3';
$mime = 'none';
if ($post->media != 'none') {
    $mime = mime_content_type($post->media);
}
$user = auth()->user();
$aut = auth()
    ->user()
    ->find($post->user_id)
    ->first();

$link_edit = route('content.edit', ['id' => $content->id]);

$profile_pic = 'img/profile_pic.png';
$n_hearts = '3000';
$n_comments = '100';
$n_shares = '100';
$time = '10 days ago';
@endphp

@include('partials.navbar')

@section('content')
  <div class="row">
    <h1>Title</h1>

    <div>
      @if ($content->contentable instanceof App\Models\MediaContent)
        <p>{{ $content->contentable->description }}</p>
      @else
        <p>{{ $content->contentable->post_text }}</p>
      @endif
    </div>


    {{ -- <div class="row justify-content-center pt-3">
      @if (strstr($mime, 'video/'))
        <video src="{{ asset($post->media) }}" controls style="max-width: 20em; max-height: 30em;"></video>
      @elseif (strstr($mime, "image/"))
        <img src="{{ asset($post->media) }}" style="max-width: 20em; max-height: 30em;"></img>
      @endif
    </div> -- }}

    <div class="d-flex justify-content-around mb-3">
      @if ($user == $content->creator)
        <a href="{{ $link_edit }}"><button type="button"
            class="btn btn-outline-secondary btn-lg bg-dark text-white">Edit Post</button></i></a>
        <form method="POST" action="{{ route('posts.destroy', $post) }}">
          @csrf
          <input type="hidden" name="_method" value="DELETE" />
          <button type="submit" value="Delete" class="btn btn-outline-danger btn-lg text-dark">Delete Post</button>
        </form>
      @endif
    </div>
  </div>


  <!-- <div class="h-100 row justify-content-between">
            <h1 class="align-self-centre">{{ $post->title }}</h1>



            <div class="d-flex flex-row justify-content-around pt-3">
                @if ($post->media == 'none')
                <div>
                    <p>{{ $post->description }}</p>
                </div>
        @else
                <div class="col-lg-8 col-md-12 col-sm-12 justify-content-center">
                    @if (strstr($mime, 'video/'))
                    <video src="{{ asset($post->media) }}" class="align-self-centre" controls style="max-width: 20em; max-height: 30em;"></video>
            @elseif (strstr($mime, "image/"))
                    <img src="{{ asset($post->media) }}" class="align-self-centre" style="max-width: 20em; max-height: 30em;"></img>
                    @endif
                </div>
                <div class="col-lg-4 d-lg-block d-none justify-content-center">
                    <p>{{ $post->description }}</p>
                </div>
                @endif
            </div>
            <div class="d-flex flex-row justify-content-between d-lg-none d-block">
                <p>{{ $post->description }}</p>
            </div>

            <div class="d-flex flex-row justify-content-between">
                <a class="" href="{{ url()->previous() }}">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                </a>

                <img src="{{ asset($profile_pic) }}" class="rounded-circle align-self-centre" style="width: 3em; height: 3em;" alt="Profile Picture" />
                <span>{{ $aut->name }}</span>
                <span class="text-secondary align-self-center mx-3">{{ $time }}</span>

                <div class="d-flex flex-col justify-content-center">
                    <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                        <i class="bi bi-chat-left-text {{ $icon_size }}"></i>
                    </button>
                    <span class="text-center">{{ $n_comments }}</span>
                </div>
                <div class="d-flex flex-col justify-content-center">
                    <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                        <i class="bi bi-heart {{ $icon_size }}"></i>
                    </button>
                    <span class="text-center">{{ $n_hearts }}</span>
                </div>
                <div class="d-flex flex-col justify-content-center">
                    <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                        <i class="bi bi-share {{ $icon_size }}"></i>
                    </button>
                    <span class="text-center">{{ $n_shares }}</span>
                </div>

                @if ($user->id == $post->user_id)
                <a href="{{ $link_edit }}"><button type="button" class="btn btn-outline-secondary btn-lg bg-dark text-white">Edit Post</button></i></a>
                <form method="POST" action="{{ route('posts.destroy', $post) }}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE" />
                    <button type="submit" value="Delete" class="btn btn-outline-danger btn-lg text-dark">Delete Post</button>
                </form>
                @endif
                
            </div>
        </div> -->
@endsection
