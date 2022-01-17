@extends('layouts.app')

@section('content')
@include('partials.navbar')




<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">About Social UP</h1>
        <p class="lead font-weight-normal mx-1">Social UP is the social network of the future. Sometimes light, sometimes overcomplicated. Classy, but functional. With strokes of genius design mixed with design choices that will make you wonder if it was done by college students who don't know what they are doing. Regardless of your opinion, you are in for a brand new, unique experience, for sure.</p>
        <a class="btn btn-outline-secondary" href="{{ route('features') }}">All Features</a>
        <a class="btn btn-outline-secondary" href="{{ route('faq') }}">Any Doubts?</a>
        <a class="btn btn-outline-secondary" href="{{ route('contacts') }}">Contact Us</a>
        <h3 class="font-weight-light mt-3">Step it up</h3>
    </div>
</div>

<div class="d-md-flex flex-md-equal justify-content-lg-between w-100 my-md-3 pl-md-3">
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">Tired of your grandma seing your posts?</h2>
            <p class="lead">She doesn't even know what a Social UP is!</p>
        </div>
    </div>
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">Stop indulging Big Tech</h2>
            <p class="lead">Support Small Tech! Douro valley is much better than silicon anyways...</p>
        </div>
    </div>
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">Go back to the roots of social connections</h2>
            <p class="lead">Simple UI + simple back-end = simple life.</p>
        </div>
    </div>
</div>

<div class="d-md-flex flex-md-equal justify-content-lg-between w-100 my-md-3 pl-md-3">
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">Don't tell Apple's designer about this page</h2>
            <p class="lead">No, seriously. They must have a lot of lawyers.</p>
        </div>
    </div>
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">Algorithms are causing the radicalization of society</h2>
            <p class="lead">That's why we barely have one! Social UP is democracy's last hope.</p>
        </div>
    </div>
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <h2 class="display-5">The most liberal form of media</h2>
            <p class="lead">We don't have a budget to censor your posts ;)</p>
        </div>
    </div>
</div>


@endsection