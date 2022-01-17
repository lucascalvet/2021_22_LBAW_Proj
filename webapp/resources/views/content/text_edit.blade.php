@php
$icon_size = 'fs-3';
$link_back = route('content.show', ['id' => $text_content->id_content]);
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
              <h2 class="text-uppercase text-center mb-5">Edit Text Content</h2>

              <form method="POST" action="{{ route('textcontent.update', ['id' => $text_content->id_content]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="form-floating mb-2">
                  <textarea class="form-control" type="text" id="post_text" name="post_text" rows="30"
                    placeholder="* Post Text" autofocus required rows="10">{{ $text_content->post_text }}</textarea>
                  <label for="post_text">* Post Text</label>

                  @if ($errors->has('post_text'))
                    <span class="invalid-feedback">
                      {{ $errors->first('post_text') }}
                    </span>
                  @endif
                </div>

                <div class="form-check d-flex justify-content-center mb-5">
                </div>

                <div class="d-flex justify-content-around mb-3">
                  <button type="submit" class="btn btn-outline-success btn-lg text-dark">Change Text Content</button>
                  <a href="{{ $link_back }}"><button type="button"
                      class="btn btn-outline-secondary btn-lg bg-dark text-white">Discard Changes</button></i></a>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
