@extends('layouts.app')

@section('title', 'Cards')

@section('content')




<div class="card m-3 list-group">
    <a href="#" class="list-group-item list-group-item-action active" aria-current="true" data-bs-toggle="list">
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
    <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="list">
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
                    <h5 class="mb-1">Username/User's actual name</h5>
                    <small class="text-muted">3 days ago</small>
                </div>
                <p class="mb-1">Notification Description or bios description (dunno).</p>
                <small class="text-muted">And some small print, whatever u want or take it out.</small>
            </div>
        </div>
    </a>
    <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="list">
        <div class="row justify-content-md-center">
            <div class="align-middle" style="max-width: 5rem;">
                <!-- <br> -->
                <svg xmlns="http://www.w3.org/2000/svg" width="4rem" height="4rem" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                    <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                </svg>
            </div>
            <div class="col">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Group without profile picture</h5>
                    <small class="text-muted">4 days ago</small>
                </div>
                <p class="mb-1">Maybe this is going to far.</p>
                <small class="text-muted">And some muted small print.</small>
            </div>
        </div>
    </a>
    <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="list">
        <div class="row justify-content-md-center">
            <div class="col">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Other type of result</h5>
                    <small class="text-muted"> <!--x days ago--> </small>
                </div>
                <p class="mb-1">For some kind of result which doesn't have a picture, if there is such a thing.</p>
                <small class="text-muted">We can also take out the date.</small>
            </div>
        </div>
    </a>
</div>

@endsection