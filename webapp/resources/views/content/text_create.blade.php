@extends('layouts.app')

@section('content')
  <section class="vh-100 bg-dark overflow-auto">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card rounded-3">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create a new Text Content</h2>

              <form method="POST" action="{{ route('textcontent.create') }}">
                @csrf

                <div class="form-floating mb-2">
                  <textarea class="form-control" type="text" id="post-text" name="post_text" placeholder="* Post Text"
                    autofocus required rows="10"></textarea>
                  <label for="post_text">* Post Text</label>

                  @if ($errors->has('post_text'))
                    <span class="invalid-feedback">
                      {{ $errors->first('post_text') }}
                    </span>
                  @endif
                </div>

                <div class="form-check d-flex justify-content-center mb-5">
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-outline-secondary btn-lg bg-dark text-white">Create Text
                    Content</button>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
