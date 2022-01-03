@extends('layouts.app')

@section('content')
  <section class="vh-100 bg-dark overflow-auto">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card rounded-3">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create a new Post</h2>

              <form method="POST" action="{{ route('post') }}" enctype="multipart/form-data">
              @csrf

                <div class="form-floating mb-2">
                  <input type="text" id="title" name="title" class="form-control form-control-lg" placeholder="* Post Title"
                    autofocus required>
                  <label for="title">* Post Title</label>
                  @if ($errors->has('title'))
                    <span class="invalid-feedback">
                      {{ $errors->first('title') }}
                    </span>
                  @endif
                </div>

                <div class="form-floating mb-2">
                  <input type="text" id="description" name="description" class="form-control form-control-lg"
                    placeholder="* Description" required>
                  <label for="description">* Description</label>
                  @if ($errors->has('description'))
                    <span class="invalid-feedback">
                      {{ $errors->first('description') }}
                    </span>
                  @endif
                </div>

                <div class="form-floating mb-2">
                  <input type="file" accept="image/*,video/*" id="media" name="media" class="form-control form-control-lg" placeholder="Media">
                  <label for="media">Media</label>
                  @if ($errors->has('media'))
                    <span class="invalid-feedback">
                      {{ $errors->first('media') }}
                    </span>
                  @endif
                </div>

                <div class="form-check d-flex justify-content-center mb-5">
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-outline-secondary btn-lg bg-dark text-white">Create Post</button>
                </div>

                <!-- <p class="text-center text-muted mt-5 mb-0">Already have an account? <a href="{{ route('login') }}"
                    class="fw-bold text-body"><u>Login here</u></a></p> -->

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
