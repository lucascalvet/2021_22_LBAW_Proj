@extends('layouts.app')

@php
$icon_size = 'fs-4';
$mime = "none";
if ($post->media != "none"){
$mime = mime_content_type($post->media);
}
$user = auth()->user();
$link_back = "/post/edit/" . $post->id

@endphp

@include('partials.navbar')

@section('content')
<div class="row">
    <h1>{{ $post->title }}</h1>
    <div>
        <p>{{ $post->description }}</p>
    </div>

    <div class="row justify-content-center pt-3">
        @if (strstr($mime, "video/"))
        <video src="{{asset($post->media)}}" controls style="max-width: 20em; max-height: 30em;"></video>
        @elseif (strstr($mime, "image/"))
        <img src="{{asset($post->media)}}" style="max-width: 20em; max-height: 30em;"></img>
        @endif
    </div>

    <div class="d-flex justify-content-around mb-3">
        @if ($user->id == $post->user_id)
        <a href="{{ $link_back }}"><button type="button" class="btn btn-outline-secondary btn-lg bg-dark text-white">Edit Post</button></i></a>
        <button type="button" class="btn btn-outline-danger btn-lg text-dark">Delete Post</button>
        @endif
        <!-- <i class="bi bi-arrow-left-circle-fill {{ $icon_size }}"></i> -->
    </div>
</div>
@stop