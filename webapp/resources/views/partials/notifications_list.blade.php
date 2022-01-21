@foreach ($notifications as $notification)
  @if (!is_null($notification->like()))
    @include('partials.notification',
    [
    'user_link' => route('profile', ['user' => $notification->like()->creator->id]),
    'profile_picture' =>
    "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png",
    'username' => $notification->like()->creator->username,
    'date' => $notification->date()->format('D, Y-m-d H:i:s'),
    'notification_generator_link' => route('content.show', ['id' => $notification->like()->id_content]),
    'description' => "Liked your post",
    'comment' => "",
    ])
  @endif
  @if (!is_null($notification->friend_request()))
    @include('partials.notification_friend_request',
    [
    'user_link' => route('profile', ['user' => $notification->friend_request()->sender->id]),
    'profile_picture' =>
    "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png",
    'username' => $notification->friend_request()->sender->username,
    'date' => $notification->date()->format('D, Y-m-d H:i:s'),
    'friendRequest'=> $notification->friend_request(),
    ])
  @endif
  @if (!is_null($notification->comment()))
    @include('partials.notification',
    [
    'user_link' => route('profile', ['user' => $notification->comment()->id_author]),
    'profile_picture' =>
    "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png",
    'username' => $notification->comment()->author->username,
    'date' => $notification->date()->format('D, Y-m-d H:i:s'),
    'notification_generator_link' => route('content.show', ['id' =>
    $notification->comment()->id_media_content]),
    'description' => "Commented your post:",
    'comment' => $notification->comment()->comment_text,
    ])
  @endif
@endforeach
