@php
$icon_size = 'fs-3';

$user = Auth::user();

$link_create_text = route('textcontent.make');
$link_create_media = route('mediacontent.make');
$users = \App\Models\User::all();
@endphp

@extends('layouts.app')

@section('title', 'Home')

@section('content')
  @include('partials.navbar')
  <div class="row text-white m-0 p-0">
    <div class="col-2 d-flex">
      @include('partials.side_create_buttons', ['id_group' => -1])
    </div>

    <div class="col-8 text-center pt-3">{{--vh-100" style="background-color: rgba(128, 128, 128, 0.027)">--}}
      @if($contents->count() != 0)
        @foreach ($contents as $content)
         <div class="d-inline-block ms-1 my-1">
            @include('partials.content', ['content' => $content, 'liked' => false, 'show_group' => true])
         </div>
        @endforeach
      @else
        <p class="mt-5">Your timeline is empty. Step it UP!</p>
      @endif
    </div>

    <div class="col-2">
      <div class="row justify-content-center mb-3 py-3">
{{--
        <div style="height: auto; max-height: 15em; overflow-y: auto;">
          <table class="table table-hover table-dark">
            <thead>
              <tr>
                <th scope="col">Picture</th>
                <th scope="col">Name</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $person)
                @if ($person != $user && $person->id != 1)

                  <tr>
                    <td><img src="{{ asset('img/profile_pic.png') }}" class="rounded-circle"
                        style="width: 3em; height: 3em;" alt="Profile Picture" /></td>
                    <td> <a href="{{ route('profile', ['user' => $person->id]) }}"> {{ $person->username }} </a></td>
                  </tr>

                @endif
              @endforeach
            </tbody>
          </table>
        </div>
        --}}

      </div>
    </div>
  </div>
@endsection
