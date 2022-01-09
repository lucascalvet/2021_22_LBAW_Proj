@php
$icon_size = 'fs-3';

$user = Auth::user();
$groups = \App\Models\Group::all();
$link_create_group = route('group.make');
@endphp

@extends('layouts.app')

@section('title', 'Group Hub')

@section('content')
@include('partials.navbar')
<div class="row bg-dark text-white" style="padding: 0em; margin: 0em;">
    <div class="col-3 d-sm-flex d-md-flex d-lg-none">
        @include('partials.side_group_buttons')
    </div>

    <div class="col-3 d-lg-block d-none">
        <div class="row justify-content-center my-3 py-3">
            <div style="height: auto; max-height: 15em; overflow-y: auto;">
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Groups</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $group)
                        <tr>
                            <td><a href="{{ route('group.show', ['id' => $group->id])}}"> {{ $group->name }} </a></td>
                            {{-- <td> <a href="{{ route('profile', ['user' => $person->id])}}"> Name </a></td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @include('partials.side_buttons')
    </div>
    <div class="col-8">
        <div class="d-flex flex-column pt-3 pl-3 pr-1" style="overflow-y: visible;">
            @foreach ($groups as $group)
            @if (count($group->contents) > 0)
            <h5>{{ $group-> name }}</h5>
            @endif
            <div class="d-flex flex-row mx-2 mb-2 pb-2" style="overflow-x: auto;">
                @foreach ($group->contents as $content)
                <div class="d-block mx-2 pb-2">
                @include('partials.content', ['content' => $content])
                </div>
                @endforeach
            </div>

            @endforeach
        </div>

        <div class="d-none d-lg-flex justify-content-center py-3">
            <a href="{{ $link_create_group }}">
                <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                    <i class="bi bi-plus-circle {{ $icon_size }}"></i>
                </button>
            </a>
        </div>
    </div>
</div>
@endsection