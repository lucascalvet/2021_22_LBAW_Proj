@php
$icon_size = 'fs-3';

$user = Auth::user();
$contents = \App\Models\Content::orderBy('publishing_date', 'desc');
if (!Auth::check() || !Auth::user()->isAdmin()) {
    $contents = $contents->where('id_creator', '<>', 1);
}
$contents = $contents->get()->filter(function ($value, $key) {
    if ($value->contentable instanceof \App\Models\TextContent) {
        return $value->contentable->isRoot();
    }
    return true;
});
$link_create_text = route('textcontent.make');
$link_create_media = route('mediacontent.make');
$users = \App\Models\User::all();
@endphp

@extends('layouts.app')

@section('title', 'Home')

@section('content')
  @include('partials.navbar')
  <div class="row vh-100 overflow-auto bg-dark text-white" style="padding: 0em; margin: 0em;">
    <div class="col-3 d-sm-flex d-md-flex d-lg-none">
      @include('partials.side_create_buttons', ['id_group' => -1])
    </div>

    <div class="col-3 d-lg-block d-none align-self-center">
      <div class="row justify-content-center mb-3 py-3">
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
      </div>

      @include('partials.side_buttons')
    </div>

    <div class="col-8">
      <div class="d-flex flex-row pt-3 pl-3 pr-1" style="overflow-x: auto;">
        @foreach ($contents as $content)
          <div class="d-block mx-2 pb-2">
            @include('partials.content', ['content' => $content, 'liked' => false, 'show_group' => true])
          </div>
        @endforeach
      </div>

      @include('partials.create_buttons')
    </div>
  </div>
@endsection
