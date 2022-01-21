<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FriendRequest;

use Illuminate\Support\Facades\DB;

class FriendRequestController extends Controller
{
    public function addFriend(Request $request, $user){
        $auth_user = $request->user();
        $friend_request = new FriendRequest;
        $friend_request->id_sender = $auth_user->id;
        $friend_request->id_receiver = $user;

        $friend_request->save();

        $res = json_encode(array(
            'user_id' => $user,
        ));

        return $res;
    }

    public function cancelFriend(Request $request, $user){
        $auth_user = $request->user();
        DB::table('friend_request')
                ->where('id_sender', $auth_user->id)
                ->where('id_receiver', $user)->delete();
        $res = json_encode(array(
            'user_id' => $user,
        ));

        return $res;
    }

  

    // public function acceptFriendRequest(Request $request, $friend_request){

    // }

}
