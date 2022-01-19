<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FriendRequest;

class FriendRequestController extends Controller
{
    public function addFriend(Request $request, $user){
        $auth_user = $request->user();
        $friend_request = new FriendRequest;
        $friend_request->id_sender = $auth_user->id;
        $friend_request->id_receiver = $user;

        $friend_request->save();

        return redirect()->route('profile',['user'=>$user]);
    }

  

    // public function acceptFriendRequest(Request $request, $friend_request){

    // }

}
