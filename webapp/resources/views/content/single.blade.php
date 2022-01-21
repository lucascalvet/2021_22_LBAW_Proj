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

@section('title', 'Post')

@section('bg_color', 'white')

@section('content')
  @include('partials.navbar')
  <div class="container-fluid pb-3">
    <h1 class="text-center mt-5 fw-bold">
      <a href="{{ route('profile', ['user' => $content->creator->id]) }}" class="text-center mt-5 fw-bold">
        {{ $content->creator->name }}
      </a>
      @if ($content->id_group != null)
        <span class="fs-4">
          @ <a href="{{ route('group.show', ['id' => $content->id_group]) }}">
            {{ App\Models\Group::find($content->id_group)->name }}</a>
        </span>
      @endif
    </h1>
    <div class="text-center text-secondary">
      {{ $content->publishing_date->format('D, Y-m-d H:i:s') }}
      @if ($content->contentable instanceof App\Models\TextContent && !$content->contentable->isRoot())
        <br>
        In response to <a class="text-truncate"
          href="{{ route('content.show', ['id' => $content->contentable->parent->first()->id_content]) }}">{{ $content->contentable->parent->first()->content->creator->name }}</a>
      @endif
    </div>
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

    <div>
      @if ($content->contentable instanceof App\Models\MediaContent)
        <div class="row justify-content-center m-0 p-0">
          @if ($content->contentable->media_contentable instanceof App\Models\Video)
            <video src="{{ asset($content->contentable->media) }}" controls style="max-width: 50em;"></video>
          @elseif ($content->contentable->media_contentable instanceof App\Models\Image)
            <img src="{{ asset($content->contentable->media) }}" style="max-width: 40em;" />
          @endif
        </div>
      @endif
    </div>

    <div class="d-flex justify-content-center mt-3 mb-3">
      @auth
        @if ($content->id_group != null && Auth::user()->can('deleteFromGroup', $content))
          <a href="{{ $link_remove }}"><button type="button" class="btn btn-outline-warning btn-lg text-dark me-3">Remove
              from Group</button></i></a>
        @endif
        @if (Auth::user()->can('update', $content))
          <a href="{{ $link_edit }}"><button type="button"
              class="btn btn-outline-secondary btn-lg bg-dark text-white me-3">Edit Post</button></i></a>
        @endif
        @if (Auth::user()->can('delete', $content))
          <form method="POST" action="{{ route('content.destroy', $content) }}">
            @csrf
            <input type="hidden" name="_method" value="DELETE" />
            <button type="submit" value="Delete" class="btn btn-outline-danger btn-lg text-dark">Delete Post</button>
          </form>
        @endif
      @endauth
    </div>

    @if ($content->contentable instanceof App\Models\MediaContent)
      @if ($content->contentable->media_contentable instanceof App\Models\Video)
        <hr>
        <h4>Description:</h4>
        <p>{{ $content->contentable->description }}</p>
      @endif
      <hr>
      <div id="comments">
        @if ($content->comment_count() === 0)
          <h4>No comments yet.</h4>
        @else
          <h4>Comments ({{ $content->comment_count() }}): </h4>
        @endif
        <ul class="list-group">
          @foreach ($content->contentable->comments as $comment)
            <li class="list-group-item">
              <div class="d-flex flex-row align-items-center">
                <span class="me-auto">
                  <a @if ($content->creator == $comment->author) class="fw-bold" @endif href="{{ route('profile', ['user' => $comment->author->id]) }}">
                    {{ $comment->author->username }}</a>
                  @if ($content->creator == $comment->author)<sup class="text-primary fw-bold">OP</sup> @endif
                  : {{ $comment->comment_text }}
                </span>
                <span class="text-secondary text-nowrap ps-2">
                  {{ $comment->comment_date->format('D, ') }}
                  <br class="d-sm-none text-nowrap">
                  {{ $comment->comment_date->format('Y-m-d ') }}
                  <br class="d-sm-none text-nowrap">
                  {{ $comment->comment_date->format('H:i:s') }}
                </span>
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
      </div>
    @elseif ($content->contentable instanceof App\Models\TextContent)
      <hr>
      <div id="comments">
        @if ($content->comment_count() === 0)
          <h4>No replies yet.</h4>
        @else
          <h4>Replies ({{ $content->comment_count() }}): </h4>
        @endif
        <ul class="list-group">
          @foreach ($content->contentable->replies as $reply)
            <li class="list-group-item">
              <div class="d-flex flex-row align-items-center">
                <span class="me-auto">
                  <a @if ($content->creator == $reply->content->creator) class="fw-bold" @endif href="{{ route('profile', ['user' => $reply->content->creator]) }}">
                    {{ $reply->content->creator->username }}</a>
                  @if ($content->creator == $reply->content->creator)<sup class="text-primary fw-bold">OP</sup> @endif
                  : {{ $reply->post_text }}
                </span>
                <span class="text-end text-nowrap">
                  <span class="ms-2"> 0 {{-- TODO: insert like count here*/ --}} </span>
                  <a class="text-dark text-decoration-none ms-1" href="#">
                    <i class="bi bi-heart"></i>
                  </a>
                  <br class="d-sm-none">
                  <span class="ms-3"> {{ $reply->content->comment_count() }} </span>
                  <a class="text-dark ms-1"
                    href="{{ route('content.show', ['id' => $reply->content->id, '#comments']) }}">
                    <i class="bi bi-chat-left-text"></i>
                  </a>
                </span>
                <span class="text-secondary text-nowrap ms-3">
                  {{ $reply->content->publishing_date->format('D, ') }}
                  <br class="d-sm-none">
                  {{ $reply->content->publishing_date->format('Y-m-d ') }}
                  <br class="d-sm-none">
                  {{ $reply->content->publishing_date->format('H:i:s') }}
                </span>
              </div>
            </li>
          @endforeach
          @auth
            <li class="list-group-item">
              <form method="POST" action="{{ route('textcontent.create') }}">
                @csrf
                <input type="hidden" id="parent-id" name="parent_id" value="{{ $content->id }}">
                <label for="comment-text" class="form-label fw-bold">Leave a reply:</label>
                <div class="d-flex flex-row">
                  <input type="text" id="comment-text" name='post_text' class="form-control"
                    aria-describedby="comment-help-block">
                  <button type="submit" class="btn btn-primary ms-3">Reply</button>
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
                <a class="link-secondary" href="{{ route('login') }}">Login</a> to reply.
              </span>
            </li>
          @endguest
        </ul>
      </div>
    @endif
  </div>
  </div>

@endsection
