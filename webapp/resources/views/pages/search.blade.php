@extends('layouts.app')

@section('title', 'Profile')

@section('content')

@include('partials.navbar')

<section id="profile">
  <div class="container-fluid vh-100 overflow-hidden" style="padding: 0em;padding-top: 5em; margin: 0em; background-color: #afafaf">
        <!--Computer View-->
      <div class="d-none d-md-block">
        <div class="row" style="margin-left: 3em;">
          <!--User Info-->
          <div class="col-2 m-3">
            <ul class="nav nav-pills flex-column" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active custom-tab" id="list-all-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-all">All</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-tab" id="list-posts-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-posts">Posts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-tab" id="list-people-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-people">People</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-tab" id="list-groups-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-groups">Groups</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-tab" id="list-organizations-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-organizations">Organizations</a>
              </li>
            </ul>
          </div>

          <!--Search Bar-->
          <div class="col-8">
            <div class="form-floating m-3 w-100">
                <input type="search" class="form-control" id="floatingInput" placeholder="">
                <label for="floatingInput"><i class="bi bi-search"></i></label>
            </div>
            <div class=" ms-3 d-flex justify-content-between">
                <button class="btn"><i class="bi bi-funnel-fill"></i>Other filters</button>
                <lable class="align-items-center pt-2">137 results found</lable>
            </div>
            <div class="card w-100 m-3 p-2 bg-white">
                <p>there</p>
                <p>are</p>
                <p>things</p>
                <p>inside</p>
            </div>
          </div>
          <div class="col-1 m-3">
            <button class="btn" style="font-size: 2em;"><i class="bi bi-sort-down"></i></button>
          </div>
        </div>
      </div>

      <!--Mobile View-->
      <div class="d-block d-md-none text-center">
        <div class="mt-5">
          <h2 class="pt-5">User Name</h2>

          <div class="d-flex justify-content-center">
            <div class="pb-2 pe-2"><strong>120</strong></div>
            friends
          </div>

          <div class="pb-2">Description</div>
          <div class="pb-2">Birthday</div>
          <div class="pb-2">Email</div>
          <div class="pb-2 mb-4">Phone Number</div>

          <div class="row">
            <h5>Interests</h5>

            <div class="d-flex text-light justify-content-center">
              <div class="bg-secondary rounded-3 ms-0 p-2 m-2">Interest1</div>
              <div class="bg-secondary rounded-3 ms-0 p-2 m-2">Interest2</div>
              <div class="bg-secondary rounded-3 ms-0 p-2 m-2">Interest3</div>
            </div>
          </div>
        </div>
      </div>

  </div>
</section>

@endsection