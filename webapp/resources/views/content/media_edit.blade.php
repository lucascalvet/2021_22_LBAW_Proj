@php
$icon_size = 'fs-3';
$link_back = route('content.show', ['id' => $media_content->id_content]);
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
              <h2 class="text-uppercase text-center mb-5">Edit Media Content</h2>

              <form method="POST" action="{{ route('content.update', ['id' => $media_content->id_content]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="form-floating mb-2">
                  <textarea class="form-control @if ($errors->has('description')) is-invalid @endif" type="text" id="description" name="description"
                    placeholder="* Description" autofocus rows="10" required
                    value="{{ $media_content->description }}"></textarea>
                  <label for="description">* Description</label>

                  @if ($errors->has('description'))
                    <span class="invalid-feedback">
                      {{ $errors->first('description') }}
                    </span>
                  @endif
                </div>

                <div class="form-floating mb-2">
                  <input type="file" accept="image/*,video/*" id="media" name="media" class="form-control form-control-lg @if ($errors->has('media')) is-invalid @endif"
                    placeholder="* Media" required value="{{ $media_content->media }}">
                  <label for="media">* Media</label>
                  @if ($errors->has('media'))
                    <span class="invalid-feedback">
                      {{ $errors->first('media') }}
                    </span>
                  @endif
                </div>

                <div class="form-floating mb-2">
                  <input type="text" id="alt_text" name="alt_text" class="form-control form-control-lg @if ($errors->has('alt_text')) is-invalid @endif"
                    placeholder="Media's Text Alternative" value="{{ $media_content->alt_text }}">
                  <label for="alt_text">Media's Text Alternative</label>
                  @if ($errors->has('alt_text'))
                    <span class="invalid-feedback">
                      {{ $errors->first('alt_text') }}
                    </span>
                  @endif
                </div>

                <div class="form-check d-flex justify-content-center mb-5">
                </div>

                <div class="d-flex justify-content-around mb-3">
                  <button type="submit" class="btn btn-outline-success btn-lg text-dark">Change Media Content</button>
                  <a class="btn btn-outline-secondary btn-lg bg-dark text-white" href="{{ $link_back }}">Discard Changes</a>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
