@extends('layouts.app')

@section('title', 'Cards')

@section('content')



<!-- 
<div class="card m-3 list-group"> -->
    <a href="#" class="list-group-item list-group-item-action" aria-current="true" data-bs-toggle="list">
        <div class="row justify-content-md-center">
            <div class="align-middle" style="max-width: 5rem;">
                <!-- <br> -->
                <svg xmlns="http://www.w3.org/2000/svg" width="4rem" height="4rem" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
            </div>
            <div class="col">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $username }}</h5>
                    <small>{{ $days_ago }}</small>
                </div>
                <p class="mb-1">{{ $description }}</p>
                <small>{{ $comment }}</small>
            </div>
        </div>
    </a>

@endsection