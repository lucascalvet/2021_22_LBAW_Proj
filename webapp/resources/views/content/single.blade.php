@extends('layouts.app')

@php
$icon_size = 'fs-3';
$user = Auth::user();

$link_edit = route('content.edit', ['id' => $content->id]);
$link_remove = route('content.remove', ['id' => $content->id]);

$profile_pic = 'img/profile_pic.png';
$n_hearts = '3000';
$n_comments = '100';
$n_shares = '100';
$time = '10 days ago';
@endphp



@section('content')
@include('partials.navbar')
<div class="row">

  <h1 class="text-center mt-5 fw-bold"><a href="{{ route('profile', ['user' => $content->creator->id])}}">{{$content->creator->username}}</a>
    @if($content->id_group != null)
    @ <a href="{{ route('group.show', ['id' => $content->id_group])}}"> {{ App\Models\Group::find($content->id_group)->name }}</a>
    @endif
  </h1>

  <div>
    @if ($content->contentable instanceof App\Models\MediaContent)
    <div class="text-center mb-3 mt-3 fs-3">{{ $content->contentable->description }}</div>
    @else
    <div class="text-center mb-3 mt-3 fs-3">{{ $content->contentable->post_text }}</div>
    @endif
  </div>

  @if ($content->contentable instanceof App\Models\MediaContent)
  <div class="row justify-content-center m-0 p-0">
    @if ($content->contentable->media_contentable instanceof App\Models\Video)
    <video src="{{ asset($content->contentable->media) }}" controls style="max-width: 50em; max-height: 60em;"></video>
    @elseif ($content->contentable->media_contentable instanceof App\Models\Image)
    <img src="{{ asset($content->contentable->media) }}" style="max-width: 50em; max-height: 60em;" />
    @endif
  </div>
  @endif

  <div class="d-flex justify-content-center mt-3 mb-3">
    @if ($content->id_group != null && (App\Models\Group::find($content->id_group)->moderators->contains($user) || (Auth::check() && Auth::user()->can('update', $content))))
    <a href="{{ $link_remove }}"><button type="button" class="btn btn-outline-warning btn-lg text-dark me-3">Remove from Group</button></i></a>
    @endif
    @if (Auth::check() && Auth::user()->can('update', $content))
    <a href="{{ $link_edit }}"><button type="button" class="btn btn-outline-secondary btn-lg bg-dark text-white me-3">Edit Post</button></i></a>
    <form method="POST" action="{{ route('content.destroy', $content) }}">
      @csrf
      <input type="hidden" name="_method" value="DELETE" />
      <button type="submit" value="Delete" class="btn btn-outline-danger btn-lg text-dark">Delete Post</button>
    </form>
    @endif
  </div>
</div>

@endsection