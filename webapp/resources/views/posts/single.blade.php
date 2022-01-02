@extends('layouts.app')

@php
$mime = "none";
if ($post->media != "none"){
    $mime = mime_content_type($post->media);
}
@endphp

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
</div>
@stop