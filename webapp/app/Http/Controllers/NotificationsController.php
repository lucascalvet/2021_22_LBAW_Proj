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

        //this gives us the currently logged in user
        $user = $request->user();

        //retrieves all likes notifications for the logged user
        $like_ids = LikeNotification::whereIn('id_notification', function ($query) use($user) {
            $query->select('id')
                ->from('notification')
                ->where('id_user', '=', $user->id);
        })->get();

        //retrieves all content that generated previous likes notifications
        $contents_collection = $like_ids->map(function ($item, $key) {
            return Content::whereIn('id', function ($query) use($item){
                $query->select('id_content')
                    ->from('content_like')
                    ->where('id', $item->id_like);
            })->get();
        });

        //retrieves all user that generated previous likes notifications
        $users_collection = $like_ids->map(function ($item, $key) {
            return User::whereIn('id', function ($query)  use($item) {
                $query->select('id_user')
                    ->from('content_like')
                    ->where('id', $item->id_like);
            })->get();
        });

        /*
        The same as above, but in pure sql

        SELECT id_like
        FROM like_notifications
        WHERE id_notification IN (
            SELECT id
            FROM notification
            WHERE id_user = AUTH::user
        )

        SELECT *
        FROM content
        WHERE id IN (
            SELECT id_content
            FROM content_like
            WHERE id = id_like
        )
        ...
        */

        return view('pages.notifications', [
            'type' => 'likes',
            'users' => $users_collection->first(),  //TODO: change both from first to all
            'contents' => $contents_collection->first(),
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
