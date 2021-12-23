@extends('layouts.app')

@section('title', 'Home')

<!--@include('partials.navbar')-->

@section('content')

<div class="row align-self-center text-white" style="background-color: rgb(112, 2, 237);">
    <div class="col-lg-2 align-self-center border border-primary">
        <div class="row justify-content-md-center mb-3">
            <p class="text-center"><b>Game</b></p>
        </div>
        <div class="row justify-content-md-center mb-3 p-3" style="background-color: rgb(112, 2, 237); background-image: linear-gradient(to left, rgba(0,0,0,0), rgba(255,140,0,1));">
            2000 UP
            <br>
        </div>
        <div class="row justify-content-md-center mb-3 p-3" style="background-color: rgb(112, 2, 237); background-image: linear-gradient(to left, rgba(0,0,0,0), rgba(255,140,0,1));">
            Next competition is in 2000 hours
        </div>
        <div class="row justify-content-md-center mb-3">
            <button type="button" class="btn btn-default" style="width: 4em; height: 3em; background-color: rgb(255,255,255);">
                <img src="{{asset('img/ranking.png')}}" class="w-100 h-100" alt="Ranking Button" />
            </button>
        </div>
        <div class="row justify-content-md-center mb-3">
            <button type="button" class="btn btn-default" style="width: 4em; height: 3em; background-color: rgb(255,255,255);">
                <img src="{{asset('img/vgc_icon.png')}}" class="w-100 h-100" alt="Play Button" />
            </button>
        </div>
    </div>
    <div class="col-lg-8 border border-primary">
        <div class="row justify-content-md-center">
            <div class="card my-3 text-black mx-2" style="width: 20em; height: 38em;">
                <div class="card-header">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-3">
                            <br>
                            <img src="{{asset('img/profile_pic.png')}}" class="rounded-circle" style="width: 3em; height: 3em;" alt="Profile Picture" />
                        </div>
                        <div class="col-lg-3">
                            <br>
                            <div class="row py-2">
                                Username
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <br>
                            <div class="row py-2 justify-content-md-center text-secondary">
                                10 days ago
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 3em; height: 2.5em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/expand.png')}}" class="w-100 h-100" alt="Expand Button" />
                                </button>
                            </div>
                            <div class="row mt-1 justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 3em; height: 2.5em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/dots.png')}}" class="w-100 h-100" alt="Options Button" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h5>Content Title</h5>
                    </div>
                    <div class="row justify-content-md-center">
                        <video src="{{asset('vid/ex.mp4')}}" controls style="max-width: 18em; max-height: 20em;"></video>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 4em; height: 3em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/comments.png')}}" class="w-100 h-100" alt="Comments Button" />
                                </button>
                            </div>
                            <div class="row justify-content-md-center">
                                100
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 4em; height: 3em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/heart.png')}}" class="w-100 h-100" alt="Heart Button" />
                                </button>
                            </div>
                            <div class="row justify-content-md-center">
                                200
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 4em; height: 3em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/share.png')}}" class="w-100 h-100" alt="Share Button" />
                                </button>
                            </div>
                            <div class="row justify-content-md-center">
                                100
                            </div>
                        </div>
                    </div>
                    <p class="card-text">Description: Professor do Técnico faz ganda beat com régua</p>
                </div>
            </div>
            <div class="card my-3 text-black mx-2" style="width: 20em; height: 38em;">
                <div class="card-header">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-3">
                            <br>
                            <img src="{{asset('img/profile_pic.png')}}" class="rounded-circle" style="width: 3em; height: 3em;" alt="Profile Picture" />
                        </div>
                        <div class="col-lg-3">
                            <br>
                            <div class="row py-2">
                                Username
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <br>
                            <div class="row py-2 justify-content-md-center text-secondary">
                                10 days ago
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 3em; height: 2.5em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/expand.png')}}" class="w-100 h-100" alt="Expand Button" />
                                </button>
                            </div>
                            <div class="row mt-1 justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 3em; height: 2.5em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/dots.png')}}" class="w-100 h-100" alt="Options Button" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h5>Content Title</h5>
                    </div>
                    <div class="row justify-content-md-center">
                        <video src="{{asset('vid/ex.mp4')}}" controls style="max-width: 18em; max-height: 20em;"></video>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 4em; height: 3em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/comments.png')}}" class="w-100 h-100" alt="Comments Button" />
                                </button>
                            </div>
                            <div class="row justify-content-md-center">
                                100
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 4em; height: 3em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/heart.png')}}" class="w-100 h-100" alt="Heart Button" />
                                </button>
                            </div>
                            <div class="row justify-content-md-center">
                                200
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 4em; height: 3em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/share.png')}}" class="w-100 h-100" alt="Share Button" />
                                </button>
                            </div>
                            <div class="row justify-content-md-center">
                                100
                            </div>
                        </div>
                    </div>
                    <p class="card-text">Description: Professor do Técnico faz ganda beat com régua</p>
                </div>
            </div>
            <div class="card my-3 text-black mx-2" style="width: 20em; height: 38em;">
                <div class="card-header">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-3">
                            <br>
                            <img src="{{asset('img/profile_pic.png')}}" class="rounded-circle" style="width: 3em; height: 3em;" alt="Profile Picture" />
                        </div>
                        <div class="col-lg-3">
                            <br>
                            <div class="row py-2">
                                Username
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <br>
                            <div class="row py-2 justify-content-md-center text-secondary">
                                10 days ago
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 3em; height: 2.5em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/expand.png')}}" class="w-100 h-100" alt="Expand Button" />
                                </button>
                            </div>
                            <div class="row mt-1 justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 3em; height: 2.5em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/dots.png')}}" class="w-100 h-100" alt="Options Button" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h5>Content Title</h5>
                    </div>
                    <div class="row justify-content-md-center">
                        <video src="{{asset('vid/ex.mp4')}}" controls style="max-width: 18em; max-height: 20em;"></video>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 4em; height: 3em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/comments.png')}}" class="w-100 h-100" alt="Comments Button" />
                                </button>
                            </div>
                            <div class="row justify-content-md-center">
                                100
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 4em; height: 3em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/heart.png')}}" class="w-100 h-100" alt="Heart Button" />
                                </button>
                            </div>
                            <div class="row justify-content-md-center">
                                200
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row justify-content-md-center">
                                <button type="button" class="btn btn-default" style="width: 4em; height: 3em; background-color: rgb(255,255,255);">
                                    <img src="{{asset('img/share.png')}}" class="w-100 h-100" alt="Share Button" />
                                </button>
                            </div>
                            <div class="row justify-content-md-center">
                                100
                            </div>
                        </div>
                    </div>
                    <p class="card-text">Description: Professor do Técnico faz ganda beat com régua</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 align-self-center border border-primary">
        <div class="row justify-content-md-center">
            <p class="text-center"><b>Online</b></p>
        </div>
        <div class="row justify-content-md-center mb-3 p-3">
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
                            <td>Açore</td>
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
        <div class="row justify-content-md-center my-3">
            <button type="button" class="btn btn-default" style="width: 4em; height: 3em; background-color: rgb(255,255,255);">
                <img src="{{asset('img/edit.png')}}" class="w-100 h-100" alt="Message Button" />
            </button>
        </div>
    </div>
</div>

<div class="row align-self-center text-white" style="background-color: rgb(112, 2, 237);">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
        <div class="row justify-content-md-center py-3">
        <button type="button" class="btn btn-default" style="width: 4em; height: 3em; background-color: rgb(255,255,255);">
                <img src="{{asset('img/plus.png')}}" class="w-100 h-100" alt="Plus Button" />
        </button>
        <br>
        </div>
    </div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
        <div class="row justify-content-md-center py-3">
        <button type="button" class="btn btn-default" style="width: 4em; height: 3em; background-color: rgb(255,255,255);">
                <img src="{{asset('img/bars.png')}}" class="w-100 h-100" alt="Options Button" />
        </button>
        <br>
        </div>
    </div>

    @endsection