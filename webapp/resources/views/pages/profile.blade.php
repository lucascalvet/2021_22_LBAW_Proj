@php
  $profile_pic = 'img/profile_pic.png';
  $cover_pic = 'img/cover_pic.jpg';
@endphp

@extends('layouts.app')

@section('title', 'Profile')

@section('content')

@include('partials.navbar')

<section id="profile">
  <div class="container-fluid vh-100" style="padding: 0em; margin: 0em;">
      <!--Cover Photo-->
      <div class="row h-25 m-0 mb-4 justify-content-center bg-secondary position-relative">
        <img class="rounded h-100 p-0" style="object-fit: none;" src="{{ asset($cover_pic) }}"/>
        <img class="d-none d-md-block rounded-circle w-25 position-absolute top-100 start-0 translate-middle" style="margin-left: 8em; max-height: 10em; max-width: 10em;" src="{{ asset($profile_pic) }}"/>
        <img class="d-block d-md-none rounded-circle w-25 position-absolute top-100 start-50 translate-middle" style="max-height: 10em; max-width: 10em;" src="{{ asset($profile_pic) }}"/>
        <div class="d-flex m-2">
          @if (Auth::check() && Auth::user()->can('update', $user))
        <a class="me-auto" href=" {{ route('profile.edit', ['user' => $user->id]) }}">
          <i class="bi d-block d-md-none bi-pencil-square"></i>
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
            <h2 class="pt-4">{{$user->username}}</h2>

            <div class="d-flex">
              <div class="pb-2 pe-2"><strong>120</strong></div>
              friends
              </div>

            <div class="pb-2">{{$user->name}}</div>
            <div class="pb-2">{{$user->description}}</div>
            <div class="pb-2">{{$user->birthday}}</div>
            <div class="pb-2">{{$user->email}}</div>
            <div class="pb-2 mb-4">{{$user->phone_number}}</div>

            <div class="row">
              <h5 class="text-center">Interests</h5>

              <div class="d-flex flex-wrap text-light justify-content-evenly">
                <div class="bg-secondary rounded-3 ms-0 p-2 m-2">Interest1</div>
                <div class="bg-secondary rounded-3 ms-0 p-2 m-2">Interest2</div>
                <div class="bg-secondary rounded-3 ms-0 p-2 m-2">Interest3</div>
              </div>
            </div>
          </div>

          <!--User Content-->
          <div class="col-8">

            <!--Content Type-->
            <div class="d-flex border-bottom border-3">
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
            <div class="d-flex flex-row text-light overflow-auto">
                @foreach($user->contents as $content)
                      <div class="d-block mx-3 bg-secondary rounded-3"> @include('partials.content', ['content' => $content])</div>
                      {{--<div class="p-5 m-2 mx-1 bg-secondary shadow rounded-3"> @include('partials.mini_post', ['content' => $content])--}}
                @endforeach
            </div>

            <div class="row d-none d-md-block mt-5 text-end">
              @if (Auth::check() && Auth::user()->can('update', $user))
                <a href="{{ route('profile.edit', ['user' => $user->id]) }}">
                  <i class="bi bi-pencil-square"></i>
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>

      <!--Mobile View-->
      <div class="d-block d-md-none text-center">
        <div class="mt-5">
          <h2 class="pt-5">{{$user->username}}</h2>

          <div class="d-flex justify-content-center">
            <div class="pb-2 pe-2"><strong>120</strong></div>
            friends
          </div>

          <div class="pb-2">{{$user->name}}</div>
          <div class="pb-2">{{$user->description}}</div>
          <div class="pb-2">{{$user->birthday}}</div>
          <div class="pb-2">{{$user->email}}</div>
          <div class="pb-2 mb-4">{{$user->phone_number}}</div>

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