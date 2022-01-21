@php
$only_viewed = false; //not doing anything yet
@endphp

@extends('layouts.app')

@section('title', 'Notifications')

@section('bg_color', '#afafaf')

@section('content')

  @include('partials.navbar')

  <section id="profile">
    <div class="container-fluid">

      <!--Computer View-->
      <div class="d-none d-md-block p-0 pt-3 m-0">
        <div class="row" style="margin-left: 3em;">
          <!--Filters-->
          <div class="col-2 m-3 mt-5 pt-4">
            <ul class="nav nav-pills flex-column" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link custom-tab-left @if (Route::currentRouteName() == 'notifications') active @endif" id="list-all-list"
                  href="{{ route('notifications') }}" role="tab" aria-controls="list-all">All</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-tab-left @if (Route::currentRouteName() == 'notifications.friend_requests') active @endif" id="list-friend-requests-list"
                  href="{{ route('notifications.friend_requests') }}" role="tab"
                  aria-controls="list-friend-requests">Friend Requests</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-tab-left @if (Route::currentRouteName() == 'notifications.likes') active @endif" id="list-likes-list"
                  href="{{ route('notifications.likes') }}" role="tab" aria-controls="list-likes">Likes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-tab-left @if (Route::currentRouteName() == 'notifications.comments') active @endif" id="list-comments-list"
                  href="{{ route('notifications.comments') }}" role="tab" aria-controls="list-comments">Comments</a>
              </li>
            </ul>
          </div>

          <div class="col-7">
            <h1 class="ms-3 me-4 mt-0 mb-4 text-light fw-bold">Notifications</h1>

            <!--Actual Notifications-->
            <div class="m-3 list-group">
              @if ($notifications->count() > 0)
                @include('partials.notifications_list', ['notifications' => $notifications])
              @else
                <div class="">You do not have notifications at this moment.</div>
              @endif
            </div>
          </div>

          <div class="col-2 mt-5 ms-2 pt-1">
            @if ($only_viewed == false)
              <a id="a-only-viewed" style="font-size: 1.7em;"><i class="bi bi-bookmark-check"></i></a>
            @else
              <a id="a-only-viewed" style="font-size: 1.7em;"><i class="bi bi-bookmark-check-fill"></i></a>
            @endif
          </div>
        </div>
      </div>

      <!--Mobile View-->
      <div class="d-block d-md-none" style="padding: 0em;padding-top: 2em; margin: 0em;">
        <h1 class="mt-0 mb-3 text-light text-center fw-bold">Notifications</h1>

        <!--Filters-->
        <div class="d-flex justify-content-center mb-3">
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link custom-tab-bottom @if (Route::currentRouteName() == 'notifications') active @endif" id="list-all-list"
                href="{{ route('notifications') }}" role="tab" aria-controls="list-all">All</a>
            </li>
            <li class="nav-item">
              <a class="nav-link custom-tab-bottom @if (Route::currentRouteName() == 'notifications.friend_requests') active @endif" id="list-friend-requests-list"
                href="{{ route('notifications.friend_requests') }}" role="tab"
                aria-controls="list-friend-requests">Friend Requests</a>
            </li>
            <li class="nav-item">
              <a class="nav-link custom-tab-bottom @if (Route::currentRouteName() == 'notifications.likes') active @endif" id="list-likes-list"
                href="{{ route('notifications.likes') }}" role="tab" aria-controls="list-likes">Likes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link custom-tab-bottom @if (Route::currentRouteName() == 'notifications.comments') active @endif" id="list-comments-list"
                href="{{ route('notifications.comments') }}" role="tab" aria-controls="list-comments">Comments</a>
            </li>
          </ul>
        </div>

        <!--Actual Notifications-->
        <div class="me-5 ms-5">
          @if ($notifications->count() > 0)
            @include('partials.notifications_list', ['notifications' => $notifications])
          @else
            <div class="">You do not have notifications at this moment.</div>
          @endif
        </div>

      </div>
    </div>

    </div>
  </section>

@endsection
