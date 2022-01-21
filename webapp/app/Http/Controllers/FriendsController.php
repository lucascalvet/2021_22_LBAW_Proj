<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\FriendRequest;

use Illuminate\Support\Facades\DB;

class FriendsController extends Controller
{
    public function acceptFriend(Request $request, $friendRequestId){
        $friendRequest = FriendRequest::findOrFail($friendRequestId);

        $user = User::findOrFail($friendRequest->id_receiver);
        $user->friends()->attach($friendRequest->id_sender);

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

    public function removeFriend(Request $request, $user_id){
        //this gives us the currently logged in user
        $user = $request->user();
        // $user->friends()->detach($user_id);              NOT WORKING EVERY TIME

        DB::table('friends')                                // ALWAYS WORKING
                ->where('id_user1', $user_id)
                ->where('id_user2', $user->id)->delete();

        DB::table('friends')
                ->where('id_user2', $user_id)
                ->where('id_user1', $user->id)->delete();


        $res = json_encode(array(
            'user_id' => $user_id,
            'auth_id' => $user->id,
        ));

        return $res;
    }

}
