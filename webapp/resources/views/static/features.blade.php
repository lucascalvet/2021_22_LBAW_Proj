@extends('layouts.app')

@section('content')
@include('partials.navbar')




<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">Features</h1>
        <p class="lead font-weight-normal mx-1">All that Social UP has to offer</p>
        <a class="btn btn-outline-secondary" href="{{ route('faq') }}">Any Doubts?</a>
        <a class="btn btn-outline-secondary" href="{{ route('about') }}">About Social UP</a>
        <a class="btn btn-outline-secondary" href="{{ route('contacts') }}">Contact Us</a>
        <h3 class="font-weight-light mt-3">Step it up</h3>
    </div>
</div>

<div class="d-md-flex flex-md-equal justify-content-lg-between w-100 my-md-3 pl-md-3">
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">Log In</h2>
            <p class="lead">Here you are <b>authentic</b>ated</p>
        </div>
    </div>
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">Search for any Content, Profile and much more...</h2>
            <p class="lead">We don't take any responsability for what you might find.</p>

        </div>
    </div>
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">Log Out</h2>
            <p class="lead">What goes in... also goes out</p>
        </div>
    </div>
</div>

<div class="d-md-flex flex-md-equal justify-content-lg-between w-100 my-md-3 pl-md-3">
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">Content of any kind</h2>
            <p class="lead">What? You thought it would all be 20 second clips? Pfffff...</p>
        </div>
    </div>
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">Join (or Create) a new Group</h2>
            <p class="lead">Like Man have been doing since the dawn of time, if you really think about it.</p>
        </div>
    </div>
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">View Notifications</h2>
            <p class="lead">Cause your life wasn't stressful enough as it was...</p>
        </div>
    </div>
</div>

<div class="d-md-flex flex-md-equal justify-content-lg-between w-100 my-md-3 pl-md-3">
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">Message each other</h2>
            <p class="lead">To massage each other you have to go to a different place.</p>
        </div>
    </div>
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">Dynamic Comments depending on the Content</h2>
            <p class="lead">See... Twitter is not very special now, is it?</p>
        </div>
    </div>
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">Play Games</h2>
            <p class="lead">One day eventually...</p>

        </div>
    </div>
</div>

<div class="d-md-flex flex-md-equal justify-content-lg-between w-100 my-md-3 pl-md-3">
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">Make Friends</h2>
            <p class="lead">They are worth it (sometimes).</p>
        </div>
    </div>
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">React to Posts</h2>
            <p class="lead">In a non agressive way, of course.</p>
        </div>
    </div>
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">Customize your Profile</h2>
            <p class="lead">Creating a profile that really feels like it's yours takes some time. But at least it's not a flipping VR avatar!</p>
        </div>
    </div>
</div>


@endsection