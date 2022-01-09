<div>
    <div class="row justify-content-md-center">
        <div class="col" style="max-width: 5rem;">
            <a href="{{ $user_link }}">
                <img class="rounded-circle w-100 m-3" src="{{ $profile_picture }}"/>
            </a>
        </div>
        <div class="col m-3">
            <div class="d-flex w-100 justify-content-between">
                <a href="{{ $user_link }}"><h5 class="mb-1">{{ $username }}</h5></a>
                <small>{{ $time_passed }}</small>
            </div>
            <a href="{{ $notification_generator_link }}">
                <p class="mb-1">{{ $description }}</p>
            </a>
        </div>
    </div>
</div>