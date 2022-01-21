<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcceptFriendRequestController extends Controller
{
    public function acceptFriend(FriendRequest $friend_resquest){
        $accepted = new AcceptFriendRequest;
        $accepted->id_friend_request = $friend_resquest->id;

        $accepted->save();

        return redirect()->route('profile',['user'=>$user]);
    }
}
