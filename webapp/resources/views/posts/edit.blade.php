@php 
$icon_size = 'fs-3';
$link_back = "/post/" . $post->id;
$user = auth()->user();
@endphp

@extends('layouts.app')

@section('content')
<section class="vh-100 bg-dark overflow-auto">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            @if ($user->id == $post->user_id)
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card rounded-3">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center mb-5">Edit the Post</h2>

                        <form method="POST" action="{{ route('post.edit', $post) }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('patch') }}

                            <div class="form-floating mb-2">
                                <input type="text" id="title" name="title" class="form-control form-control-lg" placeholder="* Post Title" autofocus value="{{ $post->title }}" required>
                                <label for="title">* Post Title</label>
                                @if ($errors->has('title'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </span>
                                @endif
                            </div>

                            <div class="form-floating mb-2">
                                <input type="text" id="description" name="description" class="form-control form-control-lg" placeholder="* Description" value="{{ $post->description }}" required>
                                <label for="description">* Description</label>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </span>
                                @endif
                            </div>

                            <div class="form-floating mb-2">
                                <input type="file" accept="image/*,video/*" id="media" name="media" class="form-control form-control-lg" placeholder="Media" value="{{ $post->media }}">
                                <label for="media">Media</label>
                                @if ($errors->has('media'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('media') }}
                                </span>
                                @endif
                            </div>

                            <div class="form-check d-flex justify-content-center mb-5">
                            </div>

                            <div class="d-flex justify-content-around mb-3">
                                <button type="submit" class="btn btn-outline-danger btn-lg text-dark">Change Post</button>
                                <!-- <i class="bi bi-arrow-left-circle-fill {{ $icon_size }}"></i> -->
                                <a href="{{ $link_back }}"><button type="button" class="btn btn-outline-secondary btn-lg bg-dark text-white">Discard Changes</button></i></a>
                            </div>


                            <!-- <p class="text-center text-muted mt-5 mb-0">Already have an account? <a href="{{ route('login') }}"
                    class="fw-bold text-body"><u>Login here</u></a></p> -->

                        </form>

                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

@endsection