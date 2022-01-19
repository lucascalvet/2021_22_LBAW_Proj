<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\FriendRequest;

class FriendsController extends Controller
{
    public function acceptFriend(Request $request, $friendRequestId){
        $friendRequest = FriendRequest::findOrFail($friendRequestId);

        $user = User::findOrFail($friendRequest->id_receiver);
        $user->friend()->attach($friendRequest->id_sender);

        $friendRequest = FriendRequest::findOrFail($friendRequestId);
        $friendRequest->delete();
        return redirect()->route('notifications.friend_requests');
    }

    public function rejectFriend(Request $request, $friendRequestId){
        $friendRequest = FriendRequest::findOrFail($friendRequestId);
        // dd($friendRequest);
        $friendRequest->delete();
        return redirect()->route('notifications.friend_requests');

    }

}
