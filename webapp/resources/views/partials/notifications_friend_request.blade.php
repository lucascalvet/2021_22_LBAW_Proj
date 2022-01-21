<div class="bg-white rounded-3 mb-2">
    <div class="row justify-content-md-center">
        <div class="col" style="max-width: 5rem;">
            <a href="{{ $user_link }}">
                <img class="rounded-circle w-100 m-3" src="{{ $profile_picture }}"/>
            </a>
        </div>
        <div class="col m-3">
            <div class="d-flex w-100 justify-content-between">
                <a href="{{ $user_link }}"><h5 class="mb-1">{{ $username }}</h5></a>
                <div>
                    <small>{{ $date }}</small>
                    <i class="bi bi-bookmark-check-fill ms-2"></i>
                </div>
            </div>
                <div class="d-flex w-100 justify-content-between">
                <a href="{{ $notification_generator_link }}">
                    <p class="mb-1">{{ $description }}</p>
                </a>
                <div>
                    <form method="POST" action="{{ route('profile.acceptFriend', ['friendRequestId' => $friendRequest->id])}}">
                        @csrf
                        <button class="border-0 p-0 me-1" type="submit"><i class="bi bi-check-square-fill"></i></button>
                    </form>
                    <form method="POST" action="{{ route('profile.rejectFriend', ['friendRequestId' => $friendRequest->id])}}">
                        @csrf
                        <!-- <input type="hidden" name="friend_request_id" value="{{ $friendRequest->id }}"> -->
                        <button class="border-0 p-0" type="submit"><i class="bi bi-x-square-fill"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

