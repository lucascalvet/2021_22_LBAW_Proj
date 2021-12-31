@extends('layouts.app')

@section('content')
  <section class="vh-100 bg-dark text-white overflow-auto">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <div class="mt-md-4 pb-5">

                <h1 class="fw-bold mb-2 display-1">Social UP</h1>
                <h3 class="text-white-50 mb-5 pb-5">Step it up</h3>

                <form method="POST" action="{{ route('login') }}">
                  {{ csrf_field() }}
                  <div class="form-outline form-white mb-4">
                    <input type="email" id="email" name="email"
                      class="form-control form-control-lg rounded-pill @if ($errors->has('email')) is-invalid @endif"
                      value="{{ old('email') }}" placeholder="email" required autofocus>
                    @if ($errors->has('email'))
                      <span class="invalid-feedback">
                        {{ $errors->first('email') }}
                      </span>
                    @endif
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input type="password" id="password" name="password"
                      class="form-control form-control-lg rounded-pill @if ($errors->has('password')) is-invalid @endif" placeholder="password"
                      required>
                    @if ($errors->has('password'))
                      <span class="invalid-feedback">
                        {{ $errors->first('password') }}
                      </span>
                    @endif
                  </div>

                  <div class="form-check mb-4 p-0 d-flex justify-content-center">
                    <input class="form-check-input mx-0" type="checkbox" name="remember" value="" id="flexCheckDefault"
                      type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label ms-2" for="flexCheckDefault">
                      Remember Me
                    </label>
                  </div>

                  <!-- <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p> -->

                  <div class="d-flex justify-content-center">
                    <button class="btn btn-outline-light btn-lg px-5" type="submit">&nbsp;Sign In&nbsp;</button>
                  </div>
                </form>
                <br>
                <div class="d-flex justify-content-center">
                  <a class="btn btn-outline-light btn-lg px-5" href="{{ route('register') }}">Sign Up</a>
                </div>

                <div class="text-center mt-5 pt-1">
                  <h5 class="mb-1">Coming soon...</h5>
                  <div class="d-flex justify-content-center">
                    {{-- <a href="#!" class="text-white"> --}}
                    <i class="bi bi-google fs-2 text-muted"></i>
                    {{-- </a> --}}
                    {{-- <a href="#!" class="text-white ms-5"> --}}
                    <i class="bi bi-apple fs-2 ms-5 text-muted"></i>
                    {{-- </a> --}}
                    {{-- <a href="#!" class="text-white ms-5"> --}}
                    <i class="bi bi-github fs-2 ms-5 text-muted"></i>
                    {{-- </a> --}}
                  </div>
                </div>

              </div>

              <div>
                <p class="mb-0">Forgot your password? <a href="#!" class="text-white-50 fw-bold">Recover it</a>
                </p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="position-absolute bottom-0 end-0 m-5">
      <a href="#!" class="text-white"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
          fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
        </svg></a>
    </div>
    <div class="modal top fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
      data-mdb-backdrop="true" data-mdb-keyboard="true">
      <div class="modal-dialog modal-lg ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">...</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--
                                                                                                      <h2>Step it up</h2>
                                                                                                      <form method="POST" action="{{ route('login') }}">
                                                                                                          {{ csrf_field() }}

                                                                                                          <label for="email">E-mail</label>
                                                                                                          <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                                                                                          @if ($errors->has('email'))
                                                                                                              <span class="error">
                                                                                                                {{ $errors->first('email') }}
                                                                                                              </span>
                                                                                                          @endif

                                                                                                          <label for="password" >Password</label>
                                                                                                          <input id="password" type="password" name="password" required>
                                                                                                          @if ($errors->has('password'))
                                                                                                              <span class="error">
                                                                                                                  {{ $errors->first('password') }}
                                                                                                              </span>
                                                                                                          @endif

                                                                                                          <label>
                                                                                                              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                                                                          </label>

                                                                                                          <button type="submit">Sign In</button>
                                                                                                          <a class="button button-outline" href="{{ route('register') }}">Sign Up</a>
                                                                                                      </form>-->
@endsection
