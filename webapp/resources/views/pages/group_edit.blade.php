@php
$icon_size = 'fs-3';
$group = \App\Models\Group::find($id);
$link_back = route('group.show', ['id' => $group->id]);
$user = Auth::user();
@endphp

@extends('layouts.app')

@section('content')
<section class="vh-100 bg-dark overflow-auto">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card rounded-3">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center mb-5">Edit Group</h2>

                        <form method="POST" action="{{ route('group.update', ['id' => $group->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="form-floating mb-2">
                                <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="* Name" required value="{{ $group->name }}">
                                <label for="name">* Name</label>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </span>
                                @endif
                            </div>

                            <div class="form-floating mb-2">
                                <textarea class="form-control" type="text" id="description" name="description" placeholder="* Description" autofocus required rows="10" value="{{ $group->description }}"></textarea>
                                <label for="description">* Description</label>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </span>
                                @endif
                            </div>

                            <div class="form-check d-flex justify-content-center mb-5">
                            </div>

                            <div class="d-flex justify-content-around mb-3">
                                <button type="submit" class="btn btn-outline-success btn-lg text-dark">Change Group</button>
                                <a href="{{ $link_back }}"><button type="button" class="btn btn-outline-secondary btn-lg bg-dark text-white">Discard Changes</button></i></a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection