@php
$profile_pic = 'img/profile_pic.png';
$cover_pic = 'img/cover_pic.jpg';
@endphp

@extends('layouts.app')

@section('title', 'Profile')

@section('bg_color', '#afafaf')

@section('content')

@include('partials.navbar')

<section id="profile">
  <div class="container-fluid p-0 m-0 vh-100">
    <!--Cover Photo-->
    <div class="row h-25 m-0 mb-4 justify-content-center position-relative">
      <img class="rounded h-100 p-0" style="object-fit: none;" src="{{ asset($cover_pic) }}" />
      <img class="d-none d-md-block rounded-circle w-25 position-absolute top-100 start-0 translate-middle" style="margin-left: 8em; max-height: 10em; max-width: 10em;" src="{{ asset($user->profile_picture) }}" />
      <img class="d-block d-md-none rounded-circle w-25 position-absolute top-100 start-50 translate-middle" style="max-height: 10em; max-width: 10em;" src="{{ asset($user->profile_picture) }}" />
      <div class="d-flex m-2">
        @if (Auth::check() && Auth::user()->can('update', $user))
        <a class="me-auto" href=" {{ route('profile.edit', ['user' => $user->id]) }}">
          <i class="bi d-block d-md-none bi-pencil-square"></i>
        </a>
        <a class="me-auto" href=" {{ route('profile.destroy', ['user' => $user->id]) }}">
          <i class="bi d-block d-md-none bi-cross"></i>
        </a>
        @endif
        <i class="bi bi-three-dots d-block d-md-none"></i>
      </div>
    </div>

    <!--Computer View-->
    <div class="d-none d-md-block">
      <div class="row gx-5 me-2" style="margin-left: 3em;">
        <!--User Info-->
        <div class="col-4 mt-5">
          <h2 class="pt-4">{{ $user->username }}</h2>

            <div class="d-flex">
              <div class="pb-2 pe-2"><strong id="strong-friends-count">{{$user->userFriends->count()}}</strong></div>
              @if ($user->userFriends->count() == 1) friend
              @else friends
              @endif
              </div>

          <div class="pb-2">{{ $user->name }}</div>
          <div class="pb-2">{{ $user->description }}</div>
          <div class="pb-2">{{ $user->birthday }}</div>
          <div class="pb-2">{{ $user->email }}</div>
          <div class="pb-2 mb-4">{{ $user->phone_number }}</div>

            <div class="row">
              <h5 class="text-center">Friends</h5>

              <div class="d-flex flex-wrap justify-content-evenly">
                @if ($user->userFriends->count() != 0)
                  @foreach($user->userFriends as $friend)
                  <div id="a-remove-friend-div-{{$friend->id}}" class="d-block mx-2 pb-2">
                      <a hre="{{ route('profile', ['user' => $friend->id]) }}"><div>{{$friend->username}}</div></a>
                      @if(Auth::user()->id == $user->id)
                        <a id="a-remove-friend-{{$friend->id}}" class="a-remove-friend">
                          <button class="border-0 p-0"><i class="bi bi-x-square-fill"></i></button>
                        </a>
                      @endif
                  </div>
                  @endforeach
                @else
                    <p>This user has no friends. Step them up!</p>
                @endif
              </div>
              @auth
            </div>
            <div id="d-friend-request" class="d-flex justify-content-center">
              @if(Auth::user()->isFriendOf($user->id))
                <a id="remove-friend-{{$user->id}}" class="remove-friend"><button class="btn btn-secondary" type="submit">Remove Friend</button></a>
              @elseif ((Auth::user()->id != $user->id) && !($user->gotFriendRequestFrom(Auth::user())) && !(Auth::user()->gotFriendRequestFrom($user)))
                <a id="a-add-friend-{{$user->id}}" class="a-add-friend"><button class="btn btn-secondary" type="submit">Add Friend</button></a>
              @elseif ($user->gotFriendRequestFrom(Auth::user()))
                <a id="a-cancel-friend-{{$user->id}}" class="a-cancel-friend"><button class="btn btn-secondary" type="submit">Cancel Friend Request</button></a>
              @endif
            </div>
            @endauth
          </div>
          @auth
          @if ((Auth::user() != $user) && !($user->gotFriendRequestFrom(Auth::user())) && !(Auth::user()->gotFriendRequestFrom($user)))
          <div class="d-flex justify-content-center">
            <form method="POST" action="{{ route('profile.addFriend', ['user' => $user->id])}}">
              @csrf
              <button class="btn btn-secondary" type="submit">Add Friend</button>
            </form>
          </div>
          @endif
          @endauth
        </div>

          <!--User Content-->
          <div class="col-8">

            <!--Content Type-->
            <div class="d-flex border-bottom border-3 mb-3 disabled">
              <div class="ps-4 pe-2 p-2 ps-xl-5 ps-lg-4 pe-xl-5 pe-sm-3 ps-sm-4">All</div>
              <div class="pe-3 pb-2 p-2 pe-xl-5 pe-sm-3">Media</div>
              <div class="pe-3 pb-2 p-2 pe-xl-5 pe-sm-3">Text</div>
              <div class="pe-3 pb-2 p-2 pe-xl-5 pe-sm-3">Friends</div>
              <div class="me-auto pb-2 p-2 pe-xl-5 pe-sm-3">Groups</div>
              <div class="pb-2 p-2 pe-xl-4 pe-sm-3 d-none d-lg-block">
                <i class="bi bi-view-list"></i>
              </div>
              <div class="pe-sm-1 pb-2 p-2 pe-xl-4 pe-sm-3 d-none d-lg-block">
                <i class="bi bi-view-stacked"></i>
              </div>
              <div class="d-none d-md-block d-lg-none pe-sm-3 p-2">
                <i class="bi bi-three-dots"></i>
              </div>
            </div>

            <!--Actual Content for md screen and beyond-->
            {{--<div class="d-flex text-light">--}}
                @foreach($user->contents->sortBy(['publishing_date', 'desc']) as $content)
                <div class="d-inline-block ms-1 mt-2">
                    @include('partials.content', ['content' => $content, 'show_group' => true])
                </div>
                @endforeach
            {{--</div>--}}

          <!--Actual Content for md screen and beyond-->
          <div class="d-flex flex-row text-light overflow-auto">
            @foreach($user->contents->sortBy(['publishing_date', 'desc']) as $content)
            <div class="d-block mx-2 pb-2">
              @include('partials.content', ['content' => $content, 'show_group' => true])
            </div>
            @endforeach
          </div>

          <div class="row d-none d-md-block mt-5 text-end">
            @if (Auth::check() && Auth::user()->can('update', $user))
            <a href="{{ route('profile.edit', ['user' => $user->id]) }}">
              <i class="bi bi-pencil-square"></i>
            </a>
            <form method="POST" action="{{ route('profile.destroy', ['user' => $user->id]) }}">
              @csrf
              <input type="hidden" name="_method" value="DELETE" />
              <button type="submit" value="Delete" class="btn btn-outline-danger btn-lg text-white">Delete Profile</button>
            </form>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!--Mobile View-->
    <div class="d-block d-md-none text-center">
      <div class="mt-5">
        <h2 class="pt-5">{{ $user->username }}</h2>

        <div class="d-flex justify-content-center">
          <div class="pb-2 pe-2"><strong>120</strong></div>
          friends
        </div>

        <div class="pb-2">{{ $user->name }}</div>
        <div class="pb-2">{{ $user->description }}</div>
        <div class="pb-2">{{ $user->birthday }}</div>
        <div class="pb-2">{{ $user->email }}</div>
        <div class="pb-2 mb-4">{{ $user->phone_number }}</div>

        <div class="row">
          <h5>Interests</h5>

          <div class="d-flex text-light justify-content-center">
            <div class="bg-secondary rounded-3 ms-0 p-2 m-2">Interest1</div>
            <div class="bg-secondary rounded-3 ms-0 p-2 m-2">Interest2</div>
            <div class="bg-secondary rounded-3 ms-0 p-2 m-2">Interest3</div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

@endsection