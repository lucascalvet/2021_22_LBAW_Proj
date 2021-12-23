@extends('layouts.app')

@section('title', 'Notifications')

@include('partials.navbar')

@section('content')

<section id="profile">
    <div class="container vh-100">

    <div class="row">
            <div class="col-3">Filter</div>
            <div class="col-7 text-light">
                <div class="bg-secondary m-3 p-4 shadow rounded-3 d-flex align-items-center">
                    <img class="rounded-circle" style="max-height: 4.2em; max-width: 4.2em;" src="https://cdn.awsli.com.br/294/294449/produto/31325624/402d2b8271.jpg"/>
                    <div class="ps-3">notification 2</div>
                </div>
                <div class="bg-secondary m-3 p-4 shadow rounded-3 d-flex align-items-center">
                    <img class="rounded-circle" style="max-height: 4.2em; max-width: 4.2em;" src="https://cdn.awsli.com.br/294/294449/produto/31325624/402d2b8271.jpg"/>
                    <div class="ps-3">notification 2</div>
                </div>
                <div class="bg-secondary m-3 p-4 shadow rounded-3 d-flex align-items-center">
                    <img class="rounded-circle" style="max-height: 4.2em; max-width: 4.2em;" src="https://cdn.awsli.com.br/294/294449/produto/31325624/402d2b8271.jpg"/>
                    <div class="ps-3">notification 2</div>
                </div>
                <div class="bg-secondary m-3 p-4 shadow rounded-3 d-flex align-items-center">
                    <img class="rounded-circle" style="max-height: 4.2em; max-width: 4.2em;" src="https://cdn.awsli.com.br/294/294449/produto/31325624/402d2b8271.jpg"/>
                    <div class="ps-3">notification 2</div>
                </div>
            </div>
            <div class="col-2">Sort</div>
        </div>

    </div>
</section>

@endsection