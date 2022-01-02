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
                <a class="nav-link active custom-tab-left" id="list-all-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-all">All</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-tab-left" id="list-posts-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-posts">Posts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-tab-left" id="list-people-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-people">People</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-tab-left" id="list-groups-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-groups">Groups</a>
              </li>
              <li class="nav-item">
                <a class="nav-link custom-tab-left" id="list-organizations-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-organizations">Organizations</a>
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
            <div class="card w-100 m-3 bg-white" style="border-radius: 1em;">
                @include('partials.listCards',['username'=>'John Doe', 'description'=>'Studied at FEUP, currently working on fixing is life.', 'comment'=>'Son of a gun','days_ago'=>'3 hours ago'])
                @include('partials.listCards',['username'=>'Jane Doe', 'description'=>'Maried to the other guy.', 'comment'=>'Carne','days_ago'=>'yesterday'])
            </div>
          </div>
          {{-- <div class="col-1 m-3">
            <button class="btn" style="font-size: 2em;"><i class="bi bi-sort-down"></i></button>
          </div> --}}
        </div>
      </div>

      <!--Mobile View-->
      <div class="d-block d-md-none">
        <div class="d-flex justify-content-center">
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active custom-tab-bottom" id="list-all-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-all">All</a>
            </li>
            <li class="nav-item">
              <a class="nav-link custom-tab-bottom" id="list-posts-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-posts">Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link custom-tab-bottom" id="list-people-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-people">People</a>
            </li>
            <li class="nav-item">
              <a class="nav-link custom-tab-bottom" id="list-groups-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-groups">Groups</a>
            </li>
            <li class="nav-item">
              <a class="nav-link custom-tab-bottom" id="list-organizations-list" data-bs-toggle="tab" href="#" role="tab" aria-controls="list-organizations">Organizations</a>
            </li>
          </ul>
        </div>
        <div class="me-5 ms-5">
          <div class="form-floating m-3 w-100">
            <input type="search" class="form-control" id="floatingInput" placeholder="">
            <label for="floatingInput"><i class="bi bi-search"></i></label>
          </div>
          <div class=" ms-3 d-flex justify-content-between">
            <button class="btn"><i class="bi bi-funnel-fill"></i>Other filters</button>
            <lable class="align-items-center pt-2">137 results found</lable>
          </div>
          <div class="card w-100 m-3 bg-white" style="border-radius: 1em;">
            @include('partials.listCards',['username'=>'John Doe', 'description'=>'Studied at FEUP, currently working on fixing is life.', 'comment'=>'Son of a gun','days_ago'=>'3 hours ago'])
          </div>
        </div>
      </div>

  </div>
</section>

@endsection