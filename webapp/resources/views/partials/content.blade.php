@php
$icon_size = "fs-5";

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


$mime = "none";
if ($post->media != "none"){
$mime = mime_content_type($post->media);
}
$user = auth()->user();
$aut = auth()->user()->find($post->user_id)->first();
$link_edit = "/post/edit/" . $post->id;
$link_view = "/post/" . $post->id;
@endphp


<div class="card text-black p-0" style="width: 19em; max-height: 35em; height: auto; overflow-y: auto;">
    <div class="card-header">
        <div class="d-flex flex-row justify-content-between">
            <div class="d-sm-block">
                <img src="{{asset($profile_pic)}}" class="rounded-circle align-self-center" style="width: 3em; height: 3em;" alt="Profile Picture" />
                <span class="align-self-centre">{{ $aut->name }}</span>
            </div>

            <div class="d-sm-flex align-self-center">
                <a href="{{ $link_view }}" class="mx-1">
                    <button type="button" class="btn btn-secondary" style="width: auto; height: auto;">
                        <i class="bi bi-arrows-angle-expand {{ $icon_size }}"></i>
                    </button>
                </a>
                <div class="dropdown">
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownPost" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-three-dots {{ $icon_size }}"></i>
                    </button>
                    <div class="dropdown-menu" style="right: 0; left: auto;" aria-labelledby="dropdownPost">
                        @if ($user->id == $aut->id)
                        <a class="dropdown-item" href="{{ $link_edit }}">Edit Post</a>
                        <a class="dropdown-item" href="#">Delete Post</a>
                        @endif
                        <a class="dropdown-item" href="#">Other Options</a>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="text-center">
            <h5>{{ $post->title }}</h5>
        </div>
        @if ($post->media != "none")
        <div class="row justify-content-center pt-3">
            @if (strstr($mime, "video/"))
            <video src="{{asset($post->media)}}" class="align-self-centre" controls style="max-width: 18em; max-height: 30em;"></video>
            @elseif (strstr($mime, "image/"))
            <img src="{{asset($post->media)}}" class="align-self-centre" style="max-width: 20em; max-height: 30em;"></img>
            @endif
        </div>
        @else
        <p class="card-text pt-3" style="max-width: 20em;">{{ $post->description }}</p>

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
        @if ($post->media != "none")
        <p class="card-text" style="max-width: 20em;">{{ $post->description }}</p>
        @endif
    </div>
</div>

<!-- <div class="card text-black p-0" style="width: auto; height: auto;">
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
</div> -->