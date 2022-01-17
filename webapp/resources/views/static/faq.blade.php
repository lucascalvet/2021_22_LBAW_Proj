@extends('layouts.app')

@section('content')
@include('partials.navbar')




<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">FAQ</h1>
        <p class="lead font-weight-normal mx-1"><b>F</b>requently <b>A</b>sked <b>Q</b>uestions</p>
        <a class="btn btn-outline-secondary" href="{{ route('features') }}">All Features</a>
        <a class="btn btn-outline-secondary" href="{{ route('about') }}">About Social UP</a>
        <a class="btn btn-outline-secondary" href="{{ route('contacts') }}">Contact Us</a>
        <h3 class="font-weight-light mt-3">Step it up</h3>
    </div>
</div>

<div class="d-md-flex flex-md-equal justify-content-lg-between w-100 my-md-3 pl-md-3">
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">What's your main inspiration?</h2>
            <p class="lead">Our main inspiration without a doubt is Sigarra!</p>
        </div>
    </div>
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">Is Social UP safe?</h2>
            <p class="lead">I don't know. Go ask SIC or Expresso. Oh wait...</p>
        </div>
    </div>
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">What is a "Madeira"?</h2>
            <p class="lead">I believe it's some sort of boy band composed only by drunk and old englishmen.</p>
        </div>
    </div>
</div>

<div class="d-md-flex flex-md-equal justify-content-lg-between w-100 my-md-3 pl-md-3">
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">Do you have a developer on the team who is descendant of Vasco da Gama?</h2>
            <p class="lead">No. I mean, I don't know... Maybe...</p>
        </div>
    </div>
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">Who's the best cat?</h2>
            <p class="lead">Farloca S2</p>
        </div>
    </div>
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">If I want to meet a member of the dev team at 3 am where should I go?</h2>
            <p class="lead">You should go to Universidade Portucalense.</p>
        </div>
    </div>
</div>

<div class="d-md-flex flex-md-equal justify-content-lg-between w-100 my-md-3 pl-md-3">
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">Instagram, Facebook or Twitter?</h2>
            <p class="lead">How many bullets do I have?</p>
        </div>
    </div>
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">When is the real site going live?</h2>
            <p class="lead">Around the same time as Sigarra's new version.</p>
        </div>
    </div>
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">What's the best spanish name there is?</h2>
            <p class="lead">It's <b>Terezaaa</b></p>
        </div>
    </div>
</div>

<div class="d-md-flex flex-md-equal justify-content-lg-between w-100 my-md-3 pl-md-3">
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">Biscuits or cookies?</h2>
            <p class="lead">We do keep some of your cookies...</p>
        </div>
    </div>
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">Are you thinking about changing the background color?</h2>
            <p class="lead">Yes. Purple is going to be the background color in the commercial release.</p>
        </div>
    </div>
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">What if I have other questions?</h2>
            <p class="lead">Contact us using the button above.</p>
        </div>
    </div>
</div>


@endsection