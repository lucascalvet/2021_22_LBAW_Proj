@extends('layouts.app')

@php
$inputs = [
    ['name' => 'name', 'id' => 'name', 'type' => 'text', 'label' => '* Your Name', 'required' => true],
    ['name' => 'username', 'id' => 'username', 'type' => 'text', 'label' => '* Username', 'required' => true],
    ['name' => 'email', 'id' => 'email', 'type' => 'email', 'label' => '* Email', 'required' => true],
    ['name' => 'password', 'id' => 'password', 'type' => 'password', 'label' => '* Password', 'required' => true],
    ['name' => 'password_confirmation', 'id' => 'password-confirm', 'type' => 'password', 'label' => '* Confirm Password', 'required' => true],
    ['name' => 'phone_number', 'id' => 'phone-number', 'type' => 'tel', 'label' => 'Phone Number', 'required' => false],
    ['name' => 'birthday', 'id' => 'birthday', 'type' => 'date', 'label' => '* Birthday', 'required' => true],
];
@endphp

@section('content')
  <section class="vh-100 bg-dark overflow-auto">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card rounded-3">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              <form method="POST" action="{{ route('register') }}">
                @csrf
                <input type="hidden" name="country" value="1">

                @foreach ($inputs as $idx => $props)
                  <div class="form-floating mb-2">
                    <input type="{{ $props['type'] }}" id="{{ $props['id'] }}" name="{{ $props['name'] }}"
                      class="form-control form-control-lg @if ($errors->has($props['name'])) is-invalid @endif" placeholder="{{ $props['label'] }}"
                      @if ($idx == 0) autofocus @endif @if ($props['required']) required @endif>
                    <label for="{{ $props['name'] }}">{{ $props['label'] }}</label>
                    @if ($errors->has($props['name']))
                      <span class="invalid-feedback">
                        {{ $errors->first($props['name']) }}
                      </span>
                    @endif
                  </div>
                @endforeach

                {{-- <div class="form-check d-flex justify-content-center mb-5">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                  <label class="form-check-label" for="form2Example3g">
                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                  </label>
                </div> --}}

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
