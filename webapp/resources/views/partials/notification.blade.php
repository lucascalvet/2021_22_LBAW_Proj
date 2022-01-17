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
            <div class="d-flex">
                <a href="{{ $notification_generator_link }}">
                    <p class="mb-1">{{ $description }}</p>
                </a>
                <p class="ms-2 mb-1">{{ $comment }}</p>
            </div>
        </div>
    </div>
</div>