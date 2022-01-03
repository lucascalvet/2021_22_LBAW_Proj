@extends('layouts.app')

@section('title', 'Administration Posts')

@section('content')

@include('partials.navbar')

<section id="admin_accounts">
<div class="container vh-100 w-50 overflow-hidden">
    <div class="row">
        <div class="d-flex align-items-end mb-4 ps-0">
            <h2 class="me-4 mt-5">Administration</h2>
            <h3 class="me-4 mt-5 me-auto">Posts</h3>
            <a href="\admin">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </a>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <div class="row mb-5">
                <div class="d-flex px-0">
                    <div class="me-3">Search:</div>
                    <input type="text" class="w-100">
                </div>
            </div>
            <div class="row mb-5">
                <div class="d-flex px-0 justify-content-between align-items-stretch">
                    <button type="button" class="w-50 btn btn-warning me-4">Ban Content</button>
                    <button type="button" class="w-50 btn btn-success">Unban Content</button>
                </div>
            </div>
            <div class="row mb-5">
                <button type="button" class="btn btn-danger w-100">Remove Content</button>
            </div>
        </div>
        <div class="col bg-secondary rounded-3 ms-5 text-light">Search results with account selection</div>
    </div>
</div>
</section>