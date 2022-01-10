@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

  @include('partials.navbar')

  <section id="profile">
    <div class="container-fluid vh-100 overflow-auto" style="background-color: #afafaf">

      <!--Computer View-->
      <div class="d-none d-md-block" style="padding: 0em;padding-top: 3em; margin: 0em;">
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
                @if ($type == 'friend_request')
                  <a class="nav-link custom-tab-left active" id="list-friend-requests-list" href="{{ route('notifications.friend_requests') }}"
                    role="tab" aria-controls="list-friend-requests">Friend Requests</a>
                @else
                  <a class="nav-link custom-tab-left" id="list-friend-requests-list" href="{{ route('notifications.friend_requests') }}"
                    role="tab" aria-controls="list-friend-requests">Friend Requests</a>
                @endif
              </li>
              <li class="nav-item">
                @if ($type == 'like')
                <a class="nav-link custom-tab-left active" id="list-likes-list" href="{{ route('notifications.likes') }}"
                  role="tab" aria-controls="list-likes">Likes</a>
                @else
                  <a class="nav-link custom-tab-left" id="list-likes-list" href="{{ route('notifications.likes') }}"
                    role="tab" aria-controls="list-likes">Likes</a>
                @endif
              </li>
              <li class="nav-item">
                @if ($type == 'comment')
                  <a class="nav-link custom-tab-left active" id="list-comments-list" href="{{ route('notifications.comments') }}"
                    role="tab" aria-controls="list-comments">Comments</a>
                @else
                  <a class="nav-link custom-tab-left" id="list-comments-list" href="{{ route('notifications.comments') }}"
                    role="tab" aria-controls="list-comments">Comments</a>
                @endif
              </li>
            </ul>
          </div>

          <div class="col-7">
            <h1 class="ms-3 me-4 mt-0 mb-4 text-light fw-bold">Notifications</h1>

             <!--Actual Notifications $users[$i]->profile_picture-->
            <div class="m-3 list-group">
              @php
              $i = 0;
              @endphp
              @if ($type == 'like' || $type == 'all')
                @for(; $i < $content_likes->count(); $i++)

                  @include('partials.notification',
                  [
                    'user_link' => route('profile', ['user' => $users[$i]->id]),
                    'profile_picture' => "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png",
                    'username' => $users[$i]->username,
                    'date' => date_parse($content_likes[$i]->date)['year'] . "-" .
                                   date_parse($content_likes[$i]->date)['month'] . "-" .
                                   date_parse($content_likes[$i]->date)['day'] . " ".
                                   date_parse($content_likes[$i]->date)['hour'] . ":" .
                                   date_parse($content_likes[$i]->date)['minute'],
                    'notification_generator_link' => route('content.show', ['id' => $contents[$i]->id]),
                    'description' => "Liked your post",
                    'comment' => "",
                  ])
                @endfor
              @endif
              @php
              $j = 0;
              @endphp
              @if ($type == 'friend_request' || $type == 'all')
                @for(; $i < $friend_requests->count(); $i++)

                  @include('partials.notifications_friend_request',
                  [
                    'user_link' => route('profile', ['user' => $users[$i]->id]),
                    'profile_picture' => "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png",
                    'username' => $users[$i]->username,
                    'date' => date_parse($friend_requests[$j]->creation_date)['year'] . "-" .
                              date_parse($friend_requests[$j]->creation_date)['month'] . "-" .
                              date_parse($friend_requests[$j]->creation_date)['day'] . " ".
                              date_parse($friend_requests[$j]->creation_date)['hour'] . ":" .
                              date_parse($friend_requests[$j]->creation_date)['minute'],
                    'notification_generator_link' => '',
                    'description' => "Sent you a friend request",
                  ])
                  @php
                  $j++;
                  @endphp
                @endfor
              @endif
              @php
              $k = 0;
              @endphp
              @if ($type == 'comment' || $type == 'all')
                @for(; $i < $comments->count(); $i++)

                @include('partials.notification',
                [
                  'user_link' => route('profile', ['user' => $users[$i]->id]),
                  'profile_picture' => "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png",
                  'username' => $users[$i]->username,
                  'date' => date_parse($comments[$i]->comment_date)['year'] . "-" .
                                   date_parse($comments[$k]->comment_date)['month'] . "-" .
                                   date_parse($comments[$k]->comment_date)['day'] . "   ".
                                   date_parse($comments[$k]->comment_date)['hour'] . ":" .
                                   date_parse($comments[$k]->comment_date)['minute'],
                  'notification_generator_link' => route('content.show', ['id' => $comments[$k]->id_media_content]),
                  'description' => "Commented your post:",
                  'comment' => $comments[$k]->comment_text,
                ])
                @php
                $k++;
                @endphp
              @endfor
            @endif
              </div>
          </div>

            <div class="col-2 mt-5 ms-2 pt-1">
              <button onclick="style='color: white;'" class="btn" style="font-size: 1.7em;"><i class="bi bi-sort-down"></i></button>
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
              @if ($type == 'all')
                <a class="nav-link custom-tab-bottom active" id="list-all-list" href="{{ route('notifications') }}"
                  role="tab" aria-controls="list-all">All</a>
              @else
                <a class="nav-link custom-tab-bottom" id="list-all-list" href="{{ route('notifications') }}"
                  role="tab" aria-controls="list-all">All</a>
              @endif
            </li>
            <li class="nav-item">
              @if ($type == 'friend_request')
                <a class="nav-link custom-tab-bottom active" id="list-friend-requests-list" href="{{ route('notifications.friend_requests') }}"
                  role="tab" aria-controls="list-friend-requests">Friend Requests</a>
              @else
                <a class="nav-link custom-tab-bottom" id="list-friend-requests-list" href="{{ route('notifications.friend_requests') }}"
                  role="tab" aria-controls="list-friend-requests">Friend Requests</a>
              @endif
            </li>
            <li class="nav-item">
              @if ($type == 'like')
              <a class="nav-link custom-tab-bottom active" id="list-likes-list" href="{{ route('notifications.likes') }}"
                role="tab" aria-controls="list-likes">Likes</a>
              @else
                <a class="nav-link custom-tab-bottom" id="list-likes-list" href="{{ route('notifications.likes') }}"
                  role="tab" aria-controls="list-likes">Likes</a>
              @endif
            </li>
            <li class="nav-item">
              @if ($type == 'comment')
                <a class="nav-link custom-tab-bottom active" id="list-comments-list" href="{{ route('notifications.comments') }}"
                  role="tab" aria-controls="list-comments">Comments</a>
              @else
                <a class="nav-link custom-tab-bottom" id="list-comments-list" href="{{ route('notifications.comments') }}"
                  role="tab" aria-controls="list-comments">Comments</a>
              @endif
            </li>
          </ul>
        </div>

        <!--Actual Notifications-->
        <div class="me-5 ms-5">
          @php
          $i = 0;
          @endphp
          @if ($type == 'like' || $type == 'all')
            @for(; $i < $content_likes->count(); $i++)

              @include('partials.notification',
              [
                'user_link' => route('profile', ['user' => $users[$i]->id]),
                'profile_picture' => "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png",
                'username' => $users[$i]->username,
                'date' => date_parse($content_likes[$i]->date)['year'] . "-" .
                               date_parse($content_likes[$i]->date)['month'] . "-" .
                               date_parse($content_likes[$i]->date)['day'] . " ".
                               date_parse($content_likes[$i]->date)['hour'] . ":" .
                               date_parse($content_likes[$i]->date)['minute'],
                'notification_generator_link' => route('content.show', ['id' => $contents[$i]->id]),
                'description' => "Liked your post",
                'comment' => "",
              ])
            @endfor
          @endif
          @php
          $j = 0;
          @endphp
          @if ($type == 'friend_request' || $type == 'all')
            @for(; $i < $friend_requests->count(); $i++)

              @include('partials.notifications_friend_request',
              [
                'user_link' => route('profile', ['user' => $users[$i]->id]),
                'profile_picture' => "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png",
                'username' => $users[$i]->username,
                'date' => date_parse($friend_requests[$j]->creation_date)['year'] . "-" .
                          date_parse($friend_requests[$j]->creation_date)['month'] . "-" .
                          date_parse($friend_requests[$j]->creation_date)['day'] . " ".
                          date_parse($friend_requests[$j]->creation_date)['hour'] . ":" .
                          date_parse($friend_requests[$j]->creation_date)['minute'],
                'notification_generator_link' => '',
                'description' => "Sent you a friend request",
              ])
              @php
              $j++;
              @endphp
            @endfor
          @endif
          @php
          $k = 0;
          @endphp
          @if ($type == 'comment' || $type == 'all')
            @for(; $i < $comments->count(); $i++)

            @include('partials.notification',
            [
              'user_link' => route('profile', ['user' => $users[$i]->id]),
              'profile_picture' => "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png",
              'username' => $users[$i]->username,
              'date' => date_parse($comments[$i]->comment_date)['year'] . "-" .
                               date_parse($comments[$k]->comment_date)['month'] . "-" .
                               date_parse($comments[$k]->comment_date)['day'] . "   ".
                               date_parse($comments[$k]->comment_date)['hour'] . ":" .
                               date_parse($comments[$k]->comment_date)['minute'],
              'notification_generator_link' => route('content.show', ['id' => $comments[$k]->id_media_content]),
              'description' => "Commented your post:",
              'comment' => $comments[$k]->comment_text,
            ])
            @php
            $k++;
            @endphp
          @endfor
        @endif
          </div>

        </div>
      </div>

    </div>
  </section>

@endsection
