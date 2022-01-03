<div style="background-image: '{{ $image_src }}';">
    <div class="d-flex text-light">
        <div class="me-auto m-2">{{$username}}</div>
        <div class="m-2">{{$location}}</div>
    </div>

    <div class="d-flex">
        <div class="m-2">
            <div class="">
                <i class="bi bi-heart-fill"></i>
            </div>
            <div class="">count</div>
        </div>

        <div class="w-100 m-2">
            <i class="bi bi-chat-quote-fill"></i>
            <div class="d-flex w-100">
                <div class="me-auto">count</div>
                <div class="text-light">{{$date}}</div>
            </div>
        </div>
    </div>
</div>