<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikeNotification;
use App\Models\Notification;
use App\Models\Content;
use App\Models\User;

class NotificationsController extends Controller
{
    /**
     * Shows the all section on the Notifications page
     *
     * @return Response
     */
    public function all()
    {
        return view('pages.notifications', [
            'type' => 'all',
        ]);
    }

     /**
     * Shows the friend requests section on the Notifications page
     *
     * @return Response
     */
    public function friends()
    {
        return view('pages.notifications', [
            'type' => 'friend_requests',
        ]);
    }

     /**
     * Shows the likes section on the Notifications page
     *
     * @return Response
     */
    public function likes(Request $request){

        $user = $request->user();

        //Notification::where('id_user', $user->id);

        //LikeNotification::addSelect(['id_notification' => Notification::select('id')->where('id_user', $user->id);

        //$like_notifications = LikeNotification::all();

        $contents = Content::all();

        $users = User::all();

        return view('pages.notifications', [
            'type' => 'likes',
            'users' => $users,
            'contents' => $contents,
        ]);
    }

     /**
     * Shows the Comments section on the Notifications page
     *
     * @return Response
     */
    public function comments()
    {
        return view('pages.notifications', [
            'type' => 'comments',
        ]);
    }
}
