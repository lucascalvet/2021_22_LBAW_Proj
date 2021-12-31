@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

@include('partials.navbar')

<section style="background-color: #999999;" id="profile">

<div class="container vh-100">
      <h1 class="text-light pt-5 fw-bold">Editing Profile</h1>
      <div class="row gx-5">
          <div class="col-6">
            <label for="input-edit-name" class="form-label ps-3 mt-2 mb-0 fw-bold">Name</label>
            <input id="input-edit-name" type="text" class="form-control" placeholder="Name" aria-label="Username"/>

            <label for="input-edit-name" class="form-label ps-3 mt-2 mb-0 fw-bold">Email</label>
            <input id="input-edit-name" type="text" class="form-control" placeholder="Email" aria-label="Username"/>

            <label for="input-edit-name" class="form-label ps-3 mt-2 mb-0 fw-bold">Phone Number</label>
            <input id="input-edit-name" type="text" class="form-control" placeholder="Phone Number" aria-label="Username"/>

            <label for="input-edit-name" class="form-label ps-3 mt-2 mb-0 fw-bold">Birthday</label>
            <input id="input-edit-name" type="text" class="form-control" placeholder="Birthday" aria-label="Username"/>

            <label for="input-edit-name" class="form-label ps-3 mt-2 mb-0 fw-bold">Password</label>
            <input id="input-edit-name" type="text" class="form-control" placeholder="Password" aria-label="Username"/>

            <label for="input-edit-name" class="form-label ps-3 mt-2 mb-0 fw-bold">Description</label>
            <input id="input-edit-name" type="text" class="form-control pb-5" placeholder="Description" aria-label="Username"/>
          </div>

          <div class="col-6 text-center">

            <h3 class="mt-3 mb-3 fw-bold">Profile picture</h3>
            <div class="d-flex justify-content-center">
              <div class="bg-white rounded-circle p-5" style="max-width: 7em; max-height: 7em;">
                <i class="bi bi-images"></i>
              </div>
            </div>

            <h3 class="mt-4 mb-3 fw-bold">Cover picture</h3>
            <div class="bg-white rounded-3 p-5">
              <i class="bi bi-images"></i>
            </div>

            <h4 class="mt-4 mb-3 fw-bold">Interests</h4>
            <div>
              <i class="bi bi-plus-circle-fill"></i>
            </div>

          </div>
          <row class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-secondary w-25">Save</button>
          </row>
      </div>
    </div>
</section>

@endsection