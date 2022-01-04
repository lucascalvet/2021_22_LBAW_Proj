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
  <div class="row">
    <h1 class="text-center mt-5 fw-bold">Title</h1>

    <div>
      @if ($content->contentable instanceof App\Models\MediaContent)
        <div class="text-center mb-3">{{ $content->contentable->description }}</div>
      @else
        <div>{{ $content->contentable->post_text }}</div>
      @endif
    </div>

    @if ($content->contentable instanceof App\Models\MediaContent)
      <div class="row justify-content-center m-0 p-0">
        @if ($content->contentable->media_contentable instanceof App\Models\Video)
          <video src="{{ asset($content->contentable->media) }}" controls
            style="max-width: 20em; max-height: 30em;"></video>
        @elseif ($content->contentable->media_contentable instanceof App\Models\Image)
          <img src="{{ asset($content->contentable->media) }}" style="max-width: 20em; max-height: 30em;"/>
        @endif
      </div>
    @endif

    <div class="d-flex justify-content-center mt-3 mb-3">
      @if ($user == $content->creator)
        <a href="{{ $link_edit }}"><button type="button"
            class="btn btn-outline-secondary btn-lg bg-dark text-white me-3">Edit Post</button></i></a>
        <form method="POST" action="{{ route('content.destroy', $content) }}">
          @csrf
          <input type="hidden" name="_method" value="DELETE" />
          <button type="submit" value="Delete" class="btn btn-outline-danger btn-lg text-dark">Delete Post</button>
        </form>
      @endif
    </div>
  </div>

@endsection
