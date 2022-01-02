@php
$icon_size = "fs-3";
$profile_pic = "img/profile_pic.png";
$username = "John Doe";
$time = "10 days ago";
$title = "Wari(El)o(n)";
$n_hearts = "3000";
$n_comments = "100";
$n_shares = "100";
$description = "Description: Elon vestido de Wario porque reasons.";

$video = "";
$image = "img/cont_elon.jpg";

$example_video = "vid/ex.mp4";
$example_image = "img/cont_elon.jpg";

$post = App\Models\Post::find(1);
@endphp



<div class="card text-black p-0" style="width: auto; height: auto;">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="d-sm-block align-self-center">
                <img src="{{asset($profile_pic)}}" class="rounded-circle" style="width: 3em; height: 3em;" alt="Profile Picture" />
                {{ $username }}
            </div>
            <div class="d-none d-lg-flex text-secondary align-self-center mx-3">{{ $time }}</div>
            <div class="d-sm-block align-self-center"><button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                    <i class="bi bi-arrows-angle-expand {{ $icon_size }}"></i>
                </button>

                <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                    <i class="bi bi-three-dots {{ $icon_size }}"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="text-center">
            <h5>{{ $post->title }}</h5>
        </div>
        @if ($image != "" || $video != "")
        <div class="row justify-content-center pt-3">
            @if ($video != "")
            <video src="{{asset('vid/ex.mp4')}}" controls style="max-width: 20em; max-height: 30em;"></video>
            @else
            <img src="{{asset($image)}}" style="max-width: 20em; max-height: 30em;"></img>
            @endif
        </div>
        @else
        <p class="card-text pt-3" style="max-width: 20em;">{{ $description }}</p>
        @endif
        <div class="row pt-3">
            <div class="col-3">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                        <i class="bi bi-chat-left-text {{ $icon_size }}"></i>
                    </button>
                    <span class="text-center">{{ $n_comments }}</span>
                </div>
            </div>
            <div class="col-6">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                        <i class="bi bi-heart {{ $icon_size }}"></i>
                    </button>
                    <span class="text-center">{{ $n_hearts }}</span>
                </div>
            </div>
            <div class="col-3">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                        <i class="bi bi-share {{ $icon_size }}"></i>
                    </button>
                    <span class="text-center">{{ $n_shares }}</span>
                </div>
            </div>
        </div>
        @if ($image != "" || $video != "")
        <p class="card-text" style="max-width: 20em;">{{ $description }}</p>
        @endif
    </div>
</div>
