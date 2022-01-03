@extends('layouts.app')

@section('title', 'Administration')

@section('content')

@include('partials.navbar')

<section id="admin_main">
<div class="container vh-100 w-50 overflow-hidden">
    <div class="row">
        <div class="col fw-bold h3 mt-5 mb-4">Administration</div>
    </div>
    <div class="row text-light text-center">
        <a class="col link-light" href="admin/accounts">
            <div id="admin-main-option--accounts" class="admin-main-option rounded-3 bg-secondary p-5 me-5">Accounts</div>
        </a>
        <a class="col link-light" href="admin/posts">
            <div id="admin-main-option--posts" class="admin-main-option rounded-3 bg-secondary p-5 me-5">Posts</div>
        </a>
        <a class="col link-light" href="admin/statistics">
            <div id="admin-main-option--stats" class="admin-main-option rounded-3 bg-secondary p-5 me-5">Statistics</div>
        </a>
    </div>
</div>
</section>
