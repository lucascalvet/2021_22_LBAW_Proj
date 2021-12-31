@extends('layouts.app')

@section('content')
  <section class="vh-100 bg-dark overflow-auto">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card rounded-3">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              <form method="POST" action="{{ route('register') }}">

                <div class="form-floating mb-2">
                  <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="* Your Name"
                    autofocus required>
                  <label for="name">* Your Name</label>
                  @if ($errors->has('name'))
                    <span class="invalid-feedback">
                      {{ $errors->first('name') }}
                    </span>
                  @endif
                </div>

                <div class="form-floating mb-2">
                  <input type="text" id="username" name="username" class="form-control form-control-lg"
                    placeholder="* Username" required>
                  <label for="username">* Username</label>
                  @if ($errors->has('username'))
                    <span class="invalid-feedback">
                      {{ $errors->first('username') }}
                    </span>
                  @endif
                </div>

                <div class="form-floating mb-2">
                  <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="* Email"
                    required>
                  <label for="email">* Email</label>
                  @if ($errors->has('email'))
                    <span class="invalid-feedback">
                      {{ $errors->first('email') }}
                    </span>
                  @endif
                </div>

                <div class="form-floating mb-2">
                  <input type="password" id="password" name="password" class="form-control form-control-lg"
                    placeholder="* Password" required>
                  <label for="password">* Password</label>
                  @if ($errors->has('password'))
                    <span class="invalid-feedback">
                      {{ $errors->first('password') }}
                    </span>
                  @endif
                </div>

                <div class="form-floating mb-2">
                  <input type="password" id="password-confirm" name="password_confirmation"
                    class="form-control form-control-lg" placeholder="* Confirm Password" required>
                  <label for="password-confirm">* Confirm Password</label>
                </div>

                <div class="form-floating mb-2">
                  <input type="tel" id="phone-number" name="phone_number" class="form-control form-control-lg"
                    placeholder="Phone Number">
                  <label for="phone-number">Phone Number</label>
                </div>

                <div class="form-floating mb-2">
                  <input type="date" class="form-control form-control-lg" id="birthday" name="birthday"
                    placeholder="* Birthday" required>
                  <label for="birthday">* Birthday</label>
                </div>

                <div class="form-check d-flex justify-content-center mb-5">
                  <!-- <input
                                                                                                    class="form-check-input me-2"
                                                                                                    type="checkbox"
                                                                                                    value=""
                                                                                                    id="form2Example3cg"
                                                                                                  />
                                                                                                  <label class="form-check-label" for="form2Example3g">
                                                                                                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                                                                                                  </label> -->
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-outline-secondary btn-lg bg-dark text-white">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Already have an account? <a href="{{ route('login') }}"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- <form method="POST" action="{{ route('register') }}">
                                                                                    {{ csrf_field() }}

                                                                                    <label for="name">Name</label>
                                                                                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                                                                                    @if ($errors->has('name'))
                                                                                      <span class="error">
                                                                                          {{ $errors->first('name') }}
                                                                                      </span>
                                                                                    @endif

                                                                                    <label for="email">E-Mail Address</label>
                                                                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                                                                                    @if ($errors->has('email'))
                                                                                      <span class="error">
                                                                                          {{ $errors->first('email') }}
                                                                                      </span>
                                                                                    @endif

                                                                                    <label for="password">Password</label>
                                                                                    <input id="password" type="password" name="password" required>
                                                                                    @if ($errors->has('password'))
                                                                                      <span class="error">
                                                                                          {{ $errors->first('password') }}
                                                                                      </span>
                                                                                    @endif

                                                                                    <label for="password-confirm">Confirm Password</label>
                                                                                    <input id="password-confirm" type="password" name="password_confirmation" required>

                                                                                    <button type="submit">
                                                                                      Register
                                                                                    </button>
                                                                                    <a class="button button-outline" href="{{ route('login') }}">Login</a>
                                                                                </form> -->
@endsection
