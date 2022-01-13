@extends('layouts.app')

@php
$icon_size = 'fs-3';
$user = Auth::user();

$link_edit = route('content.edit', ['id' => $content->id]);

$profile_pic = 'img/profile_pic.png';
$n_hearts = '3000';
$n_comments = '100';
$n_shares = '100';
$time = '10 days ago';
@endphp



@section('content')
  @include('partials.navbar')
  <div class="container-fluid pb-3">
    <a href="{{ route('profile', ['user' => $content->creator->id]) }}">
      <h1 class="text-center mt-5 fw-bold">{{ $content->creator->name }}</h1>
    </a>

    <div>
      <div class="text-center mb-3 mt-3 fs-3">
        @if ($content->contentable instanceof App\Models\MediaContent)
          @if ($content->contentable->media_contentable instanceof App\Models\Image)
            {{ $content->contentable->description }}
          @elseif ($content->contentable->media_contentable instanceof App\Models\Video)
            {{ $content->contentable->media_contentable->title }}
          @endif
        @elseif ($content->contentable instanceof App\Models\TextContent)
          <div class="text-center mb-3 mt-3 fs-3">{{ $content->contentable->post_text }}
        @endif
      </div>
    </div>

    @if ($content->contentable instanceof App\Models\MediaContent)
      <div class="row justify-content-center m-0 p-0">
        @if ($content->contentable->media_contentable instanceof App\Models\Video)
          <video src="{{ asset($content->contentable->media) }}" controls
            style="max-width: 50em; max-height: 60em;"></video>
        @elseif ($content->contentable->media_contentable instanceof App\Models\Image)
          <img src="{{ asset($content->contentable->media) }}" style="max-width: 50em; max-height: 60em;" />
        @endif
      </div>
    @endif

    <div class="d-flex justify-content-center mt-3 mb-3">
      @if (Auth::check() && Auth::user()->can('update', $content))
        <a href="{{ $link_edit }}"><button type="button"
            class="btn btn-outline-secondary btn-lg bg-dark text-white me-3">Edit Post</button></i></a>
        <form method="POST" action="{{ route('content.destroy', $content) }}">
          @csrf
          <input type="hidden" name="_method" value="DELETE" />
          <button type="submit" value="Delete" class="btn btn-outline-danger btn-lg text-dark">Delete Post</button>
        </form>
      @endif
    </div>

    @if ($content->contentable instanceof App\Models\MediaContent)
      @if ($content->contentable->media_contentable instanceof App\Models\Video)
        <hr>
        <h4>Description:</h4>
        <p>{{ $content->contentable->description }}</p>
      @endif
      <hr>
      <div id="comments">
        @if ($content->contentable->comments->isEmpty())
          <p>No comments yet.</p>
        @else
          <h4>Comments ({{ $content->comment_count() }}): </h4>
          <ul class="list-group">
            @foreach ($content->contentable->comments as $comment)
              <li class="list-group-item">
                <div class="d-flex flex-row">
                  <span class="flex-fill">
                    <a @if ($content->creator == $comment->author) class="fw-bold" @endif href="{{ route('profile', ['user' => $comment->author->id]) }}">
                      {{ $comment->author->name }}</a>
                    @if ($content->creator == $comment->author)<sup class="text-primary fw-bold">OP</sup> @endif
                    : {{ $comment->comment_text }}
                  </span>
                  <span class="text-secondary">{{ $comment->comment_date->format('D, Y-m-d H:i:s') }}</span>
                </div>
              </li>
            @endforeach
            @auth
              <li class="list-group-item">
                <form method="POST" action="{{ route('content.comment', ['id' => $content->id]) }}">
                  @csrf
                  <label for="comment-text" class="form-label fw-bold">Leave a comment:</label>
                  <div class="d-flex flex-row">
                    <input type="text" id="comment-text" name='comment_text' class="form-control"
                      aria-describedby="comment-help-block">
                    <button type="submit" class="btn btn-primary ms-3">Comment</button>
                  </div>
                  <div id="comment-help-block" class="form-text">
                    Please have some common sense and be respectful. Don't be a downer, be a Social UPper ;)
                  </div>
                </form>
              </li>
            @endauth
            @guest
              <li class="list-group-item">
                <span class="text-secondary">
                  <a class="link-secondary" href="{{ route('login') }}">Login</a> to add a comment.
                </span>
              </li>
            @endguest
          </ul>
        @endif
      </div>
    @endif
  </div>

@endsection
