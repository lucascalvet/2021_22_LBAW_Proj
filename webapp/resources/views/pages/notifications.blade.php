@extends('layouts.app')

@section('title', 'Notifications')

@include('partials.navbar')

@section('content')

<section id="profile">
    <div class="container vh-100 bg-secondary">
    <div class="row mx-3">
            <!--Filters-->
            <div class="col-2" style="margin-top: 7em;">
                <div class="border-start border-3 ps-2 py-4 pt-3 text-light  border-light">All</div>
                <div class="border-start border-3 ps-2 py-4 border-dark">Friend Requests</div>
                <div class="border-start border-3 ps-2 py-4 border-dark">Likes</div>
                <div class="border-start border-3 ps-2 py-4 border-dark">Comments</div>
            </div>
            <!--Actual Notifications-->
            <div class="col-8 text-black">
                <h2 class="text-light mt-5 mb-4"><strong>Notifications</strong></h2>
                <div class="bg-white m-3 ms-0 p-3 ps-4 shadow rounded-3 d-flex align-items-center">
                    <img class="rounded-circle ms-3" style="max-height: 4.2em; max-width: 4.2em;" src="https://cdn.awsli.com.br/294/294449/produto/31325624/402d2b8271.jpg"/>
                    <div class="ps-3 w-100">
                        <div class="d-flex w-100">
                            <div class="me-auto"><strong>User name</strong></div>
                            <div class="d-flex mx-3 justify-content-start" style="width: 14em; font-size: 0.9em;">
                                <div class="px-2">icon1</div>
                                <div class="px-2">icon2</div>
                                <div class="px-2">2 min ago</div>
                            </div>
                        </div>
                        <div>Liked your most recent post</div>
                    </div>
                </div>
                <div class="bg-white m-3 ms-0 p-3 ps-4 shadow rounded-3 d-flex align-items-center">
                    <img class="rounded-circle ms-3" style="max-height: 4.2em; max-width: 4.2em;" src="https://cdn.awsli.com.br/294/294449/produto/31325624/402d2b8271.jpg"/>
                    <div class="ps-3 w-100">
                        <div class="d-flex w-100">
                            <div class="me-auto"><strong>Group name</strong></div>
                            <div class="d-flex mx-3 justify-content-start" style="width: 14em; font-size: 0.9em;">
                                <div class="px-2">icon1</div>
                                <div class="px-2">icon2</div>
                                <div class="px-2">14 hours ago</div>
                            </div>
                        </div>
                        <div>User X added a new post in the group</div>
                    </div>
                </div>
                <div class="bg-white m-3 ms-0 p-3 ps-4 shadow rounded-3 d-flex align-items-center">
                    <img class="rounded-circle ms-3" style="max-height: 4.2em; max-width: 4.2em;" src="https://cdn.awsli.com.br/294/294449/produto/31325624/402d2b8271.jpg"/>
                    <div class="ps-3 w-100">
                        <div class="d-flex w-100">
                            <div class="me-auto"><strong>Group name</strong></div>
                            <div class="d-flex mx-3 justify-content-start" style="width: 14em; font-size: 0.9em;">
                                <div class="px-2">icon1</div>
                                <div class="px-2">icon2</div>
                                <div class="px-2">2 days ago</div>
                            </div>
                        </div>
                        <div>User Y commented your post</div>
                    </div>
                </div>
                <div class="bg-white m-3 ms-0 p-3 ps-4 shadow rounded-3 d-flex align-items-center">
                    <img class="rounded-circle ms-3" style="max-height: 4.2em; max-width: 4.2em;" src="https://cdn.awsli.com.br/294/294449/produto/31325624/402d2b8271.jpg"/>
                    <div class="ps-3 w-100">
                        <div class="d-flex w-100">
                            <div class="me-auto"><strong>User name</strong></div>
                            <div class="d-flex mx-3 justify-content-start" style="width: 14em; font-size: 0.9em;">
                                <div class="px-2">icon1</div>
                                <div class="px-2">icon2</div>
                                <div class="px-2">1 week ago</div>
                            </div>
                        </div>
                        <div>Has sent you a friend request</div>
                    </div>
                </div>
            </div>
            <!--Sort and Search-->
            <div class="col-2 ps-4" style="margin-top: 7em;">
                <div class="d-flex mb-5">
                    <div class="px-2">icon</div>
                    Sort
                </div>
                <div class="ps-2" style="margin-top: 24em;">clear icon</div>
            </div>
        </div>

    </div>
</section>

@endsection