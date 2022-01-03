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

    @if ($content->contentable instanceof App\Models\MediaContent)
      <div class="row justify-content-center pt-3">
        @if ($content->contentable->media_contentable_type instanceof App\Models\Video)
          <video src="{{ asset($content->contentable->media) }}" controls
            style="max-width: 20em; max-height: 30em;"></video>
        @elseif ($content->contentable->media_contentable_type instanceof App\Models\Image)
          <img src="{{ asset($content->contentable->media) }}" style="max-width: 20em; max-height: 30em;"></img>
        @endif
      </div>
    @endif

    <div class="d-flex justify-content-around mb-3">
      @if ($user == $content->creator)
        <a href="{{ $link_edit }}"><button type="button"
            class="btn btn-outline-secondary btn-lg bg-dark text-white">Edit Post</button></i></a>
        <form method="POST" action="{{ route('content.destroy', $content) }}">
          @csrf
          <input type="hidden" name="_method" value="DELETE" />
          <button type="submit" value="Delete" class="btn btn-outline-danger btn-lg text-dark">Delete Post</button>
        </form>
      @endif
    </div>
  </div>

@endsection