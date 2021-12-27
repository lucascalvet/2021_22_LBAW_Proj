@php
$icon_size = 'fs-3';
@endphp

@extends('layouts.app')

@section('title', 'Home')

@include('partials.navbar')

@section('content')
<div class="container vh-100 text-white" style="background-color: rgb(112, 2, 237);">
    <div class="row align-self-center">
        <div class="col-2 d-sm-block d-md-block d-lg-none align-self-center">
        <div class="row justify-content-center mb-3">
                <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                    <i class="bi bi-bar-chart {{ $icon_size }}"></i>
                </button>
            </div>
            <div class="row justify-content-center mb-3">
                <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                    <i class="bi bi-controller {{ $icon_size }}"></i>
                </button>
            </div>
            <div class="row justify-content-center mb-3">
                <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                    <i class="bi bi-chat-dots {{ $icon_size }}"></i>
                </button>
            </div>
            <div class="row justify-content-center mb-3">
                <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                    <i class="bi bi-list {{ $icon_size }}"></i>
                </button>
            </div>
        </div>
        <div class="col-2 d-lg-block d-none align-self-center">
            <div class="row justify-content-center mb-3">
                <p class="text-center"><b>Game</b></p>
            </div>
            <div class="row justify-content-center mb-3 p-3" style="background-color: rgb(112, 2, 237); background-image: linear-gradient(to left, rgba(0,0,0,0), rgba(255,140,0,1));">
                2000 UP
                <br>
            </div>
            <div class="row justify-content-center mb-3 p-3" style="background-color: rgb(112, 2, 237); background-image: linear-gradient(to left, rgba(0,0,0,0), rgba(255,140,0,1));">
                Next competition is in 2000 hours
            </div>
            <div class="row justify-content-center mb-3">
                <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                    <i class="bi bi-bar-chart {{ $icon_size }}"></i>
                </button>
            </div>
            <div class="row justify-content-center mb-3">
                <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                    <i class="bi bi-controller {{ $icon_size }}"></i>
                </button>
            </div>
        </div>
        <div class="col-8">
            <div class="row justify-content-center pt-3">
                @include('partials.content')
            </div>
            <div class="row justify-content-center py-3">
            <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                    <i class="bi bi-plus-circle {{ $icon_size }}"></i>
                </button>
            </div>
        </div>
        <div class="col-2 d-lg-block d-none align-self-center">
            <div class="row justify-content-center">
                <p class="text-center"><b>Online</b></p>
            </div>
            <div class="row justify-content-center mb-3 p-3">
                <div class="smooth-scroll" style="height: 10em; overflow-y: auto;">
                    <table class="table table-hover table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Picture</th>
                                <th scope="col">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="{{asset('img/profile_pic.png')}}" class="rounded-circle" style="width: 3em; height: 3em;" alt="Profile Picture" /></td>
                                <td>Big SergIO</td>
                            </tr>
                            <tr>
                                <td><img src="{{asset('img/profile_pic.png')}}" class="rounded-circle" style="width: 3em; height: 3em;" alt="Profile Picture" /></td>
                                <td>AÃ§ore</td>
                            </tr>
                            <tr>
                                <td><img src="{{asset('img/profile_pic.png')}}" class="rounded-circle" style="width: 3em; height: 3em;" alt="Profile Picture" /></td>
                                <td>MagalhAPSes</td>
                            </tr>
                            <tr>
                                <td><img src="{{asset('img/profile_pic.png')}}" class="rounded-circle" style="width: 3em; height: 3em;" alt="Profile Picture" /></td>
                                <td>Koala</td>
                            </tr>
                            <tr>
                                <td><img src="{{asset('img/profile_pic.png')}}" class="rounded-circle" style="width: 3em; height: 3em;" alt="Profile Picture" /></td>
                                <td>Char Char</td>
                            </tr>
                            <tr>
                                <td><img src="{{asset('img/profile_pic.png')}}" class="rounded-circle" style="width: 3em; height: 3em;" alt="Profile Picture" /></td>
                                <td>Caveira Face</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-center my-3">
                <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                    <i class="bi bi-chat-dots {{ $icon_size }}"></i>
                </button>
            </div>
            <div class="row justify-content-center my-3">
                <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                    <i class="bi bi-list {{ $icon_size }}"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection