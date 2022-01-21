@extends('layouts.app')

@section('title', 'Edit Profile')

@section('bg_color', '#999999')

@section('content')

@include('partials.navbar')

<section id="editProfile">

  <div class="container pb-3">
    <h1 class="text-light pt-5 fw-bold">Editing Profile</h1>
    <div class="row gx-5">
      <form class="input-group" action="{{ route('profile.save', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="col-6">
          <label for="name" class="form-label ps-3 mt-2 mb-0 fw-bold">Name</label>
          <input id="name" name="name" type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" value="{{$user->name}}" aria-label="Name" />

          @if ($errors->has('name'))
            <span class="invalid-feedback">
              {{ $errors->first('name') }}
            </span>
          @endif

          <label for="email" class="form-label ps-3 mt-2 mb-0 fw-bold">Email</label>
          <input id="email" name="email" type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" value="{{$user->email}}" aria-label="Email" />

          @if ($errors->has('email'))
            <span class="invalid-feedback">
              {{ $errors->first('email') }}
            </span>
          @endif

          <label for="phone" class="form-label ps-3 mt-2 mb-0 fw-bold">Phone Number</label>
          <input id="phone" name="phone" type="text" class="form-control @if ($errors->has('phone_number')) is-invalid @endif" value="{{$user->phone_number}}" aria-label="Phone Number" />

          @if ($errors->has('phone_number'))
            <span class="invalid-feedback">
              {{ $errors->first('phone_number') }}
            </span>
          @endif

          <label for="birthday" class="form-label ps-3 mt-2 mb-0 fw-bold">Birthday</label>
          <input id="birthday" name="birthday" type="date" class="form-control  @if ($errors->has('birthday')) is-invalid @endif" value="{{$user->birthday->format('Y-m-d')}}" aria-label="Birthday" />


          @if ($errors->has('birthday'))
            <span class="invalid-feedback">
              {{ $errors->first('birthday') }}
            </span>
          @endif

          <label for="password" class="form-label ps-3 mt-2 mb-0 fw-bold">Password</label>
          <input id="password" name="password" type="password" class="form-control @if ($errors->has('password')) is-invalid @endif" placeholder="Keep empty to mantain the current password" aria-label="Password" />

          @if ($errors->has('password'))
            <span class="invalid-feedback">
              {{ $errors->first('password') }}
            </span>
          @endif

          <label for="description" class="form-label ps-3 mt-2 mb-0 fw-bold">Description</label>
          <input id="description" name="description" type="text" class="form-control pb-5 @if ($errors->has('description')) is-invalid @endif" value="{{$user->description}}" aria-label="Description" />

          @if ($errors->has('description'))
            <span class="invalid-feedback">
              {{ $errors->first('description') }}
            </span>
          @endif

          <button type="submit" value="Save" class="btn btn-success btn-lg text-white w-100 mt-3">Save</button>
        </div>

        <div class="col-6 text-center ps-3">

          <h3 class="mt-3 mb-3 fw-bold">Profile picture</h3>
          <div class="d-flex justify-content-center">
            <input type="file" id="input-edit-profile-picture" name="profile_picture" class="form-control @if ($errors->has('profile_picture')) is-invalid @endif">


            @if ($errors->has('profile_picture'))
              <span class="invalid-feedback">
                {{ $errors->first('profile_picture') }}
              </span>
            @endif
          </div>

          <h3 class="mt-4 mb-3 fw-bold">Cover picture</h3>
          <div class="d-flex justify-content-center">
            <input type="file" id="input-edit-cover-picture" name="cover_picture" class="form-control @if ($errors->has('cover_picture')) is-invalid @endif">

            @if ($errors->has('cover_picture'))
              <span class="invalid-feedback">
                {{ $errors->first('cover_picture') }}
              </span>
            @endif
          </div>
        </div>
      </form>

        <div>
          <form method="POST" action="{{ route('profile.destroy', ['user' => $user->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" value="Delete" class="btn btn-danger btn-lg text-white w-50 mt-3">Delete Profile</button>
          </form>

        </div>


        <div class="d-flex justify-content-center mt-4">
        </div>
    </div>


  </div>
</section>

<script type="text/javascript">


</script>

@endsection