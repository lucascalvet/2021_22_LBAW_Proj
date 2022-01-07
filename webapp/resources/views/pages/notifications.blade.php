@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

  @include('partials.navbar')

  <section id="profile">
    <div class="container-fluid vh-100 overflow-auto"
      style="padding: 0em;padding-top: 4em; margin: 0em; background-color: #afafaf">

      <!--Computer View-->
      <div class="d-none d-md-block">
        <div class="row" style="margin-left: 3em;">
          <!--Filters-->
          <div class="col-2 m-3 mt-5 pt-4">
            <ul class="nav nav-pills flex-column" id="pills-tab" role="tablist">
              <li class="nav-item">
                @if ($type == 'all')
                  <a class="nav-link custom-tab-left active" id="list-all-list" href="{{ route('notifications') }}"
                    role="tab" aria-controls="list-all">All</a>
                @else
                  <a class="nav-link custom-tab-left" id="list-all-list" href="{{ route('notifications') }}"
                    role="tab" aria-controls="list-all">All</a>
                @endif
              </li>
              <li class="nav-item">
                @if ($type == 'friend_requests')
                  <a class="nav-link custom-tab-left active" id="list-friend-requests-list" href="{{ route('notifications.friend_requests') }}"
                    role="tab" aria-controls="list-friend-requests">Friend Requests</a>
                @else
                  <a class="nav-link custom-tab-left" id="list-friend-requests-list" href="{{ route('notifications.friend_requests') }}"
                    role="tab" aria-controls="list-friend-requests">Friend Requests</a>
                @endif
              </li>
              <li class="nav-item">
                @if ($type == 'likes')
                <a class="nav-link custom-tab-left active" id="list-likes-list" href="{{ route('notifications.likes') }}"
                  role="tab" aria-controls="list-likes">Likes</a>
                @else
                  <a class="nav-link custom-tab-left" id="list-likes-list" href="{{ route('notifications.likes') }}"
                    role="tab" aria-controls="list-likes">Likes</a>
                @endif
              </li>
              <li class="nav-item">
                @if ($type == 'comments')
                  <a class="nav-link custom-tab-left active" id="list-comments-list" href="{{ route('notifications.comments') }}"
                    role="tab" aria-controls="list-comments">Comments</a>
                @else
                  <a class="nav-link custom-tab-left" id="list-comments-list" href="{{ route('notifications.comments') }}"
                    role="tab" aria-controls="list-comments">Comments</a>
                @endif
              </li>
            </ul>
          </div>

          <!--Results Bar-->
          <div class="col-7">
            <h1 class="ms-3 me-4 mt-0 mb-4 text-light fw-bold">Notifications</h1>
            <div class="card m-3 list-group">
              @if ($type == 'user')
                @foreach ($users as $user)
                  @include('partials.listCards', ['username' => $user->username, 'description' => $user->description,
                  'comment' => $user->email, 'days_ago'=>"User", 'link' => route('profile', ['user' => $user->id]) ])
                @endforeach
              @elseif ($type == 'post')
                @foreach ($posts as $post)
                  @include('partials.listCards', ['username' => $post->content->creator->username,
                  'description' => $post->post_text,
                  'comment' => "", 'days_ago'=>"Post", 'link' => route('content.show', ['id' => $post->content->id]) ])
                @endforeach
              @endif
              </div>
          </div>

            <div class="col-2 mt-5 ms-5 pt-1">
              <button onclick="style='color: white;'" class="btn" style="font-size: 1.7em;"><i class="bi bi-sort-down"></i></button>
            </div>
        </div>
      </div>

      <!--Mobile View-->
      <div class="d-block d-md-none">
        <div class="d-flex justify-content-center">
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active custom-tab-bottom" id="list-all-list" data-bs-toggle="tab" href="#" role="tab"
                aria-controls="list-all">All</a>
            </li>
            <li class="nav-item">
              <a class="nav-link custom-tab-bottom" id="list-posts-list" data-bs-toggle="tab" href="#" role="tab"
                aria-controls="list-posts">Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link custom-tab-bottom" id="list-people-list" data-bs-toggle="tab" href="#" role="tab"
                aria-controls="list-people">People</a>
            </li>
            <li class="nav-item">
              <a class="nav-link custom-tab-bottom" id="list-groups-list" data-bs-toggle="tab" href="#" role="tab"
                aria-controls="list-groups">Groups</a>
            </li>
            <li class="nav-item">
              <a class="nav-link custom-tab-bottom" id="list-organizations-list" data-bs-toggle="tab" href="#" role="tab"
                aria-controls="list-organizations">Organizations</a>
            </li>
          </ul>
        </div>
        <div class="me-5 ms-5">
          <div class="form-floating m-3 w-100">
            <input type="search" class="form-control" id="floatingInput" placeholder="">
            <label for="floatingInput"><i class="bi bi-search"></i></label>
          </div>
          <div class=" ms-3 d-flex justify-content-between">
            <button class="btn"><i class="bi bi-funnel-fill"></i>Other filters</button>
            <label class="align-items-center pt-2">137 results found</label>
          </div>
          {{-- <div class="card w-100 m-3 bg-white" style="border-radius: 1em;">
            @include('partials.listCards',['username'=>'John Doe', 'description'=>'Studied at FEUP, currently working on
            fixing is life.', 'comment'=>'Son of a gun','days_ago'=>'3 hours ago'])
          </div> --}}
        </div>
      </div>

    </div>
  </section>

@endsection
