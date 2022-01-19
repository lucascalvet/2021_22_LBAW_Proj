@extends('layouts.app')

@section('title', 'Search')

@section('bg_color', '#afafaf')

@section('content')

  @include('partials.navbar')

  <section id="profile">
    <div class="container-fluid p-0 pt-5 m-0">
      <!--<h1 class="ms-3 me-4 mt-0 text-light fw-bold">Search</h1>-->
      <!--Computer View-->
      <div class="d-none d-md-block">
        <div class="row" style="margin-left: 3em;">
          <!--User Info-->
          <div class="col-2 m-3">
            <ul class="nav nav-pills flex-column" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link custom-tab-left @if (Route::currentRouteName() == 'search.content') active @endif" id="list-posts-list"
                  href="{{ route('search.content') }}" role="tab" aria-controls="list-posts">Posts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-tab-left @if (Route::currentRouteName() == 'search.users') active @endif" id="list-people-list"
                  href="{{ route('search.users') }}" role="tab" aria-controls="list-people">People</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-tab-left disabled" id="list-groups-list" data-bs-toggle="tab" href="#"
                  role="tab" aria-controls="list-groups">Groups</a>
              </li>
            </ul>
          </div>

          <!--Search Bar-->
          <div class="col-8">
            <div class="form-floating m-3 w-100">
              <form action="{{ Request::url() }}" method="GET">
                <div class="d-flex flex-row">
                  <input type="text" class="form-control" id="searchInput" name="search" placeholder="Search query">
                  <button type="submit" class="btn btn-secondary ms-3">Search</button>
                  {{-- <label for="floatingInput"><i class="bi bi-search"></i></label> --}}
                </div>
              </form>
            </div>
            <div class=" ms-3 d-flex justify-content-between">
              <button disabled class="btn"><i class="bi bi-funnel-fill"></i>Other filters</button>
              @if (isset($users))
                <label class="align-items-center pt-2">{{ count($users) }} results found</label>
              @elseif (isset($posts))
                <label class="align-items-center pt-2">{{ count($posts) }} results found</label>
              @endif
            </div>
            @if ((isset($users) && count($users) > 0) || (isset($posts) && count($posts) > 0))
              <div class="card w-100 m-3 bg-white" style="border-radius: 1em;">
                <div class="card m-3 list-group">
                  @if (isset($users))
                    @foreach ($users as $user)
                      @include('partials.listCards', ['title' => $user->name, 'description' => $user->description,
                      'subtitle' => $user->username, 'date'=> $user->email, 'link' => route('profile', ['user' =>
                      $user->id]) ])
                    @endforeach
                  @elseif (isset($posts))
                    @foreach ($posts as $post)
                      @if ($post->contentable instanceof App\Models\TextContent)
                        @include('partials.listCards', ['title' => $post->creator->name,
                        'description' => $post->contentable->post_text,
                        'subtitle' => "", 'date'=>$post->publishing_date->format('D, Y-m-d H:i:s'), 'link' =>
                        route('content.show', ['id' => $post->id])
                        ])
                      @elseif ($post->contentable instanceof App\Models\MediaContent)
                        @php
                          if ($post->contentable instanceof App\Models\Video) {
                              $description = $post->contentable->media_contentable->title;
                          } else {
                              $description = $post->contentable->description;
                          }
                        @endphp
                        @include('partials.listCards', ['title' => $post->creator->name,
                        'description' => $description,
                        'subtitle' => "", 'date'=>$post->publishing_date->format('D, Y-m-d H:i:s'), 'link' =>
                        route('content.show', ['id' => $post->id])
                        ])
                      @endif
                    @endforeach
                  @endif
                </div>
              </div>
            @endif
          </div>
          {{-- <div class="col-1 m-3">
            <button class="btn" style="font-size: 2em;"><i class="bi bi-sort-down"></i></button>
          </div> --}}
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
        </div>
      </div>

    </div>
  </section>

@endsection
