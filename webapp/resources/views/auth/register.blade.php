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
['name' => 'profile_picture', 'id' => 'profile_picture', 'type' => 'file', 'accept' => 'image/*', 'label' => '* Profile Picture', 'required' => true],
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

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="country" value="1">
              <input type="hidden" name="private" value="on">

              @foreach ($inputs as $idx => $props)
              <div class="form-floating mb-2">
                <input type="{{ $props['type'] }}" id="{{ $props['id'] }}" name="{{ $props['name'] }}" class="form-control form-control-lg @if ($errors->has($props['name'])) is-invalid @endif" placeholder="{{ $props['label'] }}" @if ($idx==0) autofocus @endif @if ($props['required']) required @endif>
                <label for="{{ $props['name'] }}">{{ $props['label'] }}</label>
                @if ($errors->has($props['name']))
                <span class="invalid-feedback">
                  {{ $errors->first($props['name']) }}
                </span>
                @endif
              </div>
              @endforeach

              
              {{--<div class="d-flex mt-2 mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="private" name="private" />
                <label class="form-check-label" for="private">
                  Make profile private.
                </label>
              </div> --}}

              {{-- <div class="form-check d-flex justify-content-center mb-5">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                  <label class="form-check-label" for="form2Example3g">
                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                  </label>
                </div> --}}

              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-outline-secondary btn-lg bg-dark text-white">Register</button>
              </div>

              <p class="text-center text-muted mt-5 mb-0">Already have an account? <a href="{{ route('login') }}" class="fw-bold text-body"><u>Login here</u></a></p>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection