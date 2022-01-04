@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

@include('partials.navbar')

<section style="background-color: #999999;" id="profile">

<div class="container vh-100">
      <h1 class="text-light pt-5 fw-bold">Editing Profile</h1>
      <div class="row gx-5">
        <form class="input-group" action="{{ route('profile.save', ['user' => $user->id]) }}" method="GET">
          <div class="col-6">


            <label for="name" class="form-label ps-3 mt-2 mb-0 fw-bold">Name</label>
            <input id="name" name="name" type="text" class="form-control" placeholder="{{$user->name}}" aria-label="Name"/>

            <label for="email" class="form-label ps-3 mt-2 mb-0 fw-bold">Email</label>
            <input id="email" name="email" type="email" class="form-control" placeholder="{{$user->email}}" aria-label="Email"/>

            <label for="phone" class="form-label ps-3 mt-2 mb-0 fw-bold">Phone Number</label>
            <input id="phone" name="phone" type="text" class="form-control" placeholder="{{$user->phone_numer}}" aria-label="Phone Number"/>

            <label for="birthday" class="form-label ps-3 mt-2 mb-0 fw-bold">Birthday</label>
            <input id="birthday" name="birthday" type="date" class="form-control" placeholder="{{$user->birthday}}" aria-label="Birthday"/>

            <label for="password" class="form-label ps-3 mt-2 mb-0 fw-bold">Password</label>
            <input id="password" name="password" type="password" class="form-control" placeholder="{{$user->pasword}}" aria-label="Password"/>

            <label for="description" class="form-label ps-3 mt-2 mb-0 fw-bold">Description</label>
            <input id="description" name="description" type="text" class="form-control pb-5" placeholder="{{$user->description}}" aria-label="Description"/>

            <input type="submit" class="form-control" id="floatingInput" value="Save">


          </div>

          <div class="col-6 text-center">

            <h3 class="mt-3 mb-3 fw-bold">Profile picture</h3>
            <div class="d-flex justify-content-center">
              <div class="bg-white rounded-circle p-5" style="max-width: 7em; max-height: 7em;">
                <img id="img-profile-picture" style="display: none;">  <!--FIXME: the image uploaded overloads the circle div-->
                <div id="d-profile-picture" style="object-fit: none;">
                  <label for="input-edit-profile-picture"><i class="bi bi-images"></i></label>
                  <input type="file" id="input-edit-profile-picture" onchange='
                      document.getElementById("d-profile-picture").style.display="none";

                      let file = this.files[0];

                      let url = window.URL.createObjectURL(file);

                      console.log(url);

                      let img = document.getElementById("img-profile-picture");

                      img.src = url;

                      img.onload = function () {
                        window.URL.revokeObjectURL(this.src);
                      };

                      document.getElementById("img-profile-picture").style.display="block";

                      ' name="profile_picture" style="display: none;">
                </div>
              </div>
            </div>

            <h3 class="mt-4 mb-3 fw-bold">Cover picture</h3>
            <div class="bg-white rounded-3 p-5">  <!--FIXME: do the same thing as the profile picture input-->
              <img id="img-cover-picture" class="d-none">
              <div id="d-cover-picture">
                <label for="input-edit-cover-picture"><i class="bi bi-images"></i></label>
                <input type="file" id="input-edit-cover-picture" name="cover_picture" style="display: none;">
              </div>
            </div>

            <h4 class="mt-4 mb-3 fw-bold">Interests</h4>
            <div>
              <i class="bi bi-plus-circle-fill"></i>
            </div>

          </div>

          <div class="d-flex justify-content-center mt-4">
              <!--<button type="submit" class="btn btn-secondary w-25">Save</button>-->
          </div>
      </div>
        </form>



    </div>
</section>

<script type="text/javascript">


</script>

@endsection