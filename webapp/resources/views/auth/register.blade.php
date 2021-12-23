@extends('layouts.app')

@section('content')
<section class="vh-100 bg-image" style="background: rgb(0,0,0); background: rgba(0,0,0,0.4);">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              <form>

                <div class="form-outline mb-2">
                  <input type="text" id="formName" class="form-control form-control-lg" placeholder="Your Name *"/>
                </div>

                <div class="form-outline mb-2">
                  <input type="email" id="formUsername" class="form-control form-control-lg" placeholder="Username *"/>
                </div>

                <div class="form-outline mb-2">
                  <input type="password" id="formPassword" class="form-control form-control-lg" placeholder="Password *"/>
                </div>

                <div class="form-outline mb-2">
                  <input type="password" id="formRPassword" class="form-control form-control-lg" placeholder="Confirm Password *"/>
                </div>

                <div class="form-outline mb-2">
                  <input type="email" id="formEmail" class="form-control form-control-lg" placeholder="Email"/>
                </div>

                <div class="form-outline mb-2">
                  <input type="tel" id="formPhoneNumber" class="form-control form-control-lg" placeholder="Phone Number"/>
                </div>

                <div class="form-outline datepicker w-100">
                    <input type="text" class="form-control form-control-lg" id="birthdayDate" placeholder="Birthday Date"/>
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
                  <button type="button" class="btn btn btn-outline-secondary btn-block btn-lg bg-dark text-white">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!" class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
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
