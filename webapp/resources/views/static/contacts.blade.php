@extends('layouts.app')

@section('content')
@include('partials.navbar')




<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">Contact Us</h1>
        <p class="lead font-weight-normal mx-1">Contact us through our work emails</p>
        <a class="btn btn-outline-secondary" href="{{ route('features') }}">All Features</a>
        <a class="btn btn-outline-secondary" href="{{ route('about') }}">About Social UP</a>
        <a class="btn btn-outline-secondary" href="{{ route('faq') }}">Any Doubts?</a>
        <h3 class="font-weight-light mt-3">Step it up</h3>
    </div>
</div>

<div class="d-lg-flex flex-lg-equal justify-content-lg-between w-100 my-md-3 pl-md-3">
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-3 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">Açore</h2>
            <p class="lead">upXXXXXXXXX@fe.up.pt</p>
        </div>
    </div>
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-3 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">SergIO</h2>
            <p class="lead">upXXXXXXXXX@fe.up.pt</p>
        </div>
    </div>
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-3 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">Skywalker</h2>
            <p class="lead">upXXXXXXXXX@fe.up.pt</p>
        </div>
    </div>
    <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-3 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
            <h2 class="display-5">Koala</h2>
            <p class="lead">upXXXXXXXXX@fe.up.pt</p>
        </div>
    </div>
</div>

@endsection