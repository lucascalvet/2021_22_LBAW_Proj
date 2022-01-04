@php
$icon_size = 'fs-3';

$user = Auth::user();
$contents = \App\Models\Content::all();
$link_create_text = route('textcontent.make');
$link_create_media = route('mediacontent.make');
@endphp

@extends('layouts.app')

@section('title', 'Home')

@section('content')
  @include('partials.navbar')
  <div class="row h-100 overflow-auto bg-dark text-white" style="padding: 0em; margin: 0em;">
    <div class="col-3 d-sm-flex d-md-flex d-lg-none">
      <nav class="d-flex flex-column">
        <div class="d-flex flex-row my-3">
          <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-bar-chart {{ $icon_size }}"></i>
          </button>
          <span class="d-none d-md-block d-lg-none align-self-center ms-3">Ranking</span>
        </div>
        <div class="d-flex flex-row my-3">
          <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-controller {{ $icon_size }}"></i>
          </button>
          <span class="d-none d-md-block d-lg-none align-self-center ms-3">Games</span>
        </div>
        <div class="d-flex flex-row my-3">
          <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-chat-dots {{ $icon_size }}"></i>
          </button>
          <span class="d-none d-md-block d-lg-none align-self-center ms-3">Messages</span>
        </div>
        <div class="d-flex flex-row my-3">
          <a href="{{ $link_create_text }}">
            <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
              <i class="bi bi-pencil-square {{ $icon_size }}"></i>
            </button>
          </a>
          <span class="d-none d-md-block d-lg-none align-self-center ms-3">Create Text Content</span>
        </div>
        <div class="d-flex flex-row my-3">
          <a href="{{ $link_create_media }}">
            <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
              <i class="bi bi-file-earmark-richtext {{ $icon_size }}"></i>
            </button>
          </a>
          <span class="d-none d-md-block d-lg-none align-self-center ms-3">Create Media Content</span>
        </div>
        <div class="d-flex flex-row my-3">
          <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-list {{ $icon_size }}"></i>
          </button>
          <span class="d-none d-md-block d-lg-none align-self-center ms-3">Options</span>
        </div>

      </nav>
    </div>

    <div class="col-3 d-lg-block d-none align-self-center">
      <div class="row justify-content-center mb-3 py-3">
        <div style="height: 15em; overflow-y: auto;">
          <table class="table table-hover table-dark">
            <thead>
              <tr>
                <th scope="col">Picture</th>
                <th scope="col">Name</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><img src="{{ asset('img/profile_pic.png') }}" class="rounded-circle"
                    style="width: 3em; height: 3em;" alt="Profile Picture" /></td>
                <td>Big SergIO</td>
              </tr>
              <tr>
                <td><img src="{{ asset('img/profile_pic.png') }}" class="rounded-circle"
                    style="width: 3em; height: 3em;" alt="Profile Picture" /></td>
                <td>AÃ§ore</td>
              </tr>
              <tr>
                <td><img src="{{ asset('img/profile_pic.png') }}" class="rounded-circle"
                    style="width: 3em; height: 3em;" alt="Profile Picture" /></td>
                <td>MagalhAPSes</td>
              </tr>
              <tr>
                <td><img src="{{ asset('img/profile_pic.png') }}" class="rounded-circle"
                    style="width: 3em; height: 3em;" alt="Profile Picture" /></td>
                <td>Koala</td>
              </tr>
              <tr>
                <td><img src="{{ asset('img/profile_pic.png') }}" class="rounded-circle"
                    style="width: 3em; height: 3em;" alt="Profile Picture" /></td>
                <td>Char Char</td>
              </tr>
              <tr>
                <td><img src="{{ asset('img/profile_pic.png') }}" class="rounded-circle"
                    style="width: 3em; height: 3em;" alt="Profile Picture" /></td>
                <td>Caveira Face</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="d-flex flex-row my-3">
        <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
          <i class="bi bi-bar-chart {{ $icon_size }}"></i>
        </button>
        <span class="d-none d-lg-block align-self-center ms-3">Ranking</span>
      </div>
      <div class="d-flex flex-row my-3">
        <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
          <i class="bi bi-controller {{ $icon_size }}"></i>
        </button>
        <span class="d-none d-lg-block align-self-center ms-3">Games</span>
      </div>
      <div class="d-flex flex-row my-3">
        <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
          <i class="bi bi-chat-dots {{ $icon_size }}"></i>
        </button>
        <span class="d-none d-lg-block align-self-center ms-3">Messages</span>
      </div>
      <div class="d-flex flex-row my-3">
        <button disabled type="button" class="btn btn-secondary" style="width: auto; height: auto;">
          <i class="bi bi-list {{ $icon_size }}"></i>
        </button>
        <span class="d-none d-lg-block align-self-center ms-3">Options</span>
      </div>
    </div>
    <div class="col-8">
      <div class="d-flex flex-row pt-3 pl-3 pr-1" style="overflow-x: auto;">
        @foreach ($contents as $content)
          <div class="d-block mx-2 pb-2">
            @include('partials.content', ['content' => $content])
          </div>
        @endforeach
      </div>

      <div class="d-none d-lg-flex justify-content-around py-3">
        <a href="{{ $link_create_text }}">
          <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-pencil-square {{ $icon_size }}"></i>
          </button>
        </a>
        <a href="{{ $link_create_media }}">
          <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
            <i class="bi bi-file-earmark-richtext {{ $icon_size }}"></i>
          </button>
        </a>
      </div>
    </div>
  </div>
@endsection
