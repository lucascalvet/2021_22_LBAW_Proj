@extends('layouts.app')

@section('title', 'Administration Statistics')

@section('content')

@include('partials.navbar')

<section id="admin_accounts">
<div class="container vh-100 w-50 overflow-hidden">
    <div class="row">
        <div class="d-flex align-items-end mb-4 ps-0">
            <h2 class="me-4 mt-5">Administration</h2>
            <h3 class="me-4 mt-5 me-auto">Statistics</h3>
            <a href="\admin">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </a>
        </div>
    </div>
    <div class="row mt-2 mb-1">
        <div class="d-flex ps-0">
            <div class="me-2">Total posts:</div>
            <div>100</div>
        </div>
    </div>
    <div class="row">
        <div class="d-flex ps-0">
            <div class="me-2">Total users:</div>
            <div>100</div>
        </div>
    </div>
</div>
</section>