@php
$icon_size = 'fs-3';

$user = Auth::user();
$group = App\Models\Group::find($id);
$link_edit = route('group.edit', ['id' => $group->id]);

@endphp

@extends('layouts.app')

@section('content')
  @include('partials.navbar')
  <div class="vh-100 row bg-dark text-white" style="padding: 0em; margin: 0em; overflow: visible;">
    <h3 class="d-block d-lg-none text-center my-3"> {{ $group->name }}</h3>
    <div class="col-2 d-sm-flex d-md-flex d-lg-none">
      @include('partials.side_group_create_buttons', ['group' => $group, 'user' => $user])
    </div>

    <div class="col-2 d-lg-block d-none align-self-center mt-5">
      <div class="row justify-content-center mb-3 pb-3">
        <div style="height: auto; max-height: 15em; overflow-y: auto;">
          <table class="table table-hover table-dark">
            <thead>
              <tr>
                <th scope="col">Moderators</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($group->moderators as $mod)
                @if ($mod->id != 1)
                  <tr>
                    <td><a href="{{ route('profile', ['user' => $mod->id]) }}">{{ $mod->name }}</a></td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="row justify-content-center mb-3 py-3">
        <div style="height: auto; max-height: 15em; overflow-y: auto;">
          <table class="table table-hover table-dark">
            <thead>
              <tr>
                <th scope="col">Members</th>
                @if ($group->moderators->contains($user))
                  <th scope="col" class="text-center">Mod Controls</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($group->members as $member)
                @if ($member->id != 1 && !$group->moderators->contains($member))
                  <tr>
                    <td><a href="{{ route('profile', ['user' => $member->id]) }}">{{ $member->name }}</a></td>
                    @if ($group->moderators->contains($user))
                      <td class="d-flex flex-row justify-content-around">
                        <a href="{{ route('group.mod.join', ['id' => $group->id, 'user' => $member->id]) }}"
                          class="text-success"><i class="bi bi-arrow-up-square fs-6"></i></a>
                        <a href="{{ route('group.member.leave', ['id' => $group->id, 'user' => $member->id]) }}"
                          class="text-danger"><i class="bi bi-x-circle fs-6"></i></a>
                      </td>
                    @endif
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      @include('partials.side_group_buttons', ['group' => $group, 'user' => $user])
    </div>

    <div class="col-8 mt-4">
      <h3 class="d-none d-lg-block mt-4 mb-3 ms-3"> {{ $group->name }}</h3>

      <div class="d-none d-md-block ms-3 mb-3">{{ $group->description }}</div>

      <div class="d-flex flex-row pt-3 ms-1" style="overflow-x: auto;">
        @foreach ($group->contents as $content)
          <div class="d-block mx-2 pb-2">
            @include('partials.content', ['content' => $content, 'show_group' => false])
          </div>
        @endforeach
      </div>

      <div class="d-flex justify-content-center mt-3 mb-3">
        @if ($group->moderators->contains($user))
          <a href="{{ $link_edit }}"><button type="button"
              class="btn btn-outline-secondary btn-lg bg-dark text-white me-3">Edit Group</button></i></a>
          <form method="POST" action="{{ route('group.destroy', $group->id) }}">
            @csrf
            <input type="hidden" name="_method" value="DELETE" />
            <button type="submit" value="Delete" class="btn btn-outline-danger btn-lg text-white">Delete Group</button>
          </form>
        @endif
      </div>
    </div>

    <div class="col-2 mt-5 pt-5">
      @if ($group->members->contains($user))
      @include('partials.create_buttons', ['id_group' => $group->id])
    @endif
    </div>
  </div>
@endsection
