<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikeNotification;
use App\Models\Notification;
use App\Models\Content;
use App\Models\CommentNotification;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    /**
     * Shows the all section on the Notifications page
     *
     * @return Response
     */
    public function all(Request $request){
        return view('pages.notifications', [
            'type' => 'all',
        ]);
    }

     /**
     * Shows the friend requests section on the Notifications page
     *
     * @return Response
     */
    public function friends(Request $request){

          //this gives us the currently logged in user
          $user = $request->user();

          //retrieves all friend requests
          $friend_requests = DB::table('friend_request')->whereIn('id', function ($query) use($user) {
            $query->select('id_friend_request')
            ->from('friend_request_notification')
            ->whereIn('id_notification', function ($query) use($user) {
                $query->select('id')
                    ->from('notification')
                    ->where('id_user', '=', $user->id);
            });
            })->get();

        //retrieves all users that sent a friend request
        $users_collection = DB::table('users')->whereIn('id', function($query) use($user){
            $query->select('id_sender')
                    ->from('friend_request')
                    ->whereIn('id', function ($query) use($user) {
                $query->select('id_friend_request')
                ->from('friend_request_notification')
                ->whereIn('id_notification', function ($query) use($user) {
                    $query->select('id')
                        ->from('notification')
                        ->where('id_user', '=', $user->id);
                });
            });
        })->get();

        //dd($users_collection);

        return view('pages.notifications', [
            'type' => 'friend_request',
            'users' => $users_collection,
            'friend_requests' => $friend_requests,
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
        /*
        $likes_ids = LikeNotification::whereIn('id_notification', function ($query) use($user) {
            $query->select('id')
                ->from('notification')
                ->where('id_user', '=', $user->id);
        })->get();
        */

        //retrieves all user that generated previous likes notifications
        $users_collection = DB::table('users')->whereIn('id', function ($query) use($user) {
                $query->select('id_user')
                    ->from('content_like')
                    ->whereIn('id', function($query) use($user) {
                        $query->select('id_like')
                        ->from('like_notification')
                        ->whereIn('id_notification', function ($query) use($user) {
                            $query->select('id')
                                ->from('notification')
                                ->where('id_user', '=', $user->id);
                    });
                });
        })->get();
/*
         //retrieves all content that generated previous likes notifications
         $contents_collection = DB::table('content')->whereIn('id', function ($query) use($user) {
            $query->select('id_content')
                ->from('content_like')
                ->whereIn('id', function($query) use($user) {
                    $query->select('id_like')
                    ->from('like_notification')
                    ->whereIn('id_notification', function ($query) use($user) {
                        $query->select('id')
                            ->from('notification')
                            ->where('id_user', '=', $user->id);
                });
            });
        })->get();
        */
        $contents_collection = array();

        foreach($users_collection as $us){
             //retrieves all content that generated previous likes notifications
            array_push($contents_collection, DB::table('content')->whereIn('id', function ($query) use($user, $us) {
                $query->select('id_content')
                    ->from('content_like')
                    ->where('id_user', $us->id)
                    ->whereIn('id', function($query) use($user) {
                        $query->select('id_like')
                        ->from('like_notification')
                        ->whereIn('id_notification', function ($query) use($user) {
                            $query->select('id')
                                ->from('notification')
                                ->where('id_user', '=', $user->id);
                    });
                });
            })->first());
        }

        //dd($users_collection);

        //retrieves all content likes that generated previous likes notifications
        $content_likes = DB::table('content_like')->whereIn('id', function ($query) use($user) {
                    $query->select('id_like')
                    ->from('like_notification')
                    ->whereIn('id_notification', function ($query) use($user) {
                        $query->select('id')
                            ->from('notification')
                            ->where('id_user', '=', $user->id);
                });
        })->get();

        //dd($content_likes);

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
            'type' => 'like',
            'users' => $users_collection,
            'contents' => $contents_collection,
            'content_likes' => $content_likes,
        ]);
    }

     /**
     * Shows the Comments section on the Notifications page
     *
     * @return Response
     */
    public function comments(Request $request)
    {
        //this gives us the currently logged in user
        $user = $request->user();

        //retrieves all comments notifications for the logged user
        $comments_notifications = CommentNotification::whereIn('id_notification', function ($query) use($user) {
            $query->select('id')
                ->from('notification')
                ->where('id_user', '=', $user->id);
        })->get();

        /*
        //retrieves all contents that generated previous comments notifications
        $comments_collection = $comments_notifications->map(function ($item, $key) {
            //return Comment::where('id', '=', $item->id_comment);
            return DB::table('comment')->where('id', $item->id_comment)->get();
        });
        */

        $comments_collection = DB::table('comment')->whereIn('id', function ($query) use($user) {
            $query->select('id_comment')
                ->from('comment_notification')
                ->whereIn('id_notification', function ($query) use($user) {
                    $query->select('id')
                        ->from('notification')
                        ->where('id_user', '=', $user->id);
                });
        })->get();

       // dd($comments_collection);

        $users_collection = DB::table('users')->whereIn('id', function ($query) use($user) {
            $query->select('author')
                  ->from('comment')
                  ->whereIn('id', function ($query) use($user) {
                      $query->select('id_comment')
                            ->from('comment_notification')
                            ->whereIn('id_notification', function ($query) use($user) {
                                $query->select('id')
                                      ->from('notification')
                                      ->where('id_user', '=', $user->id);
                                });
                        });
        })->get();

/*
        $users_collection = $comments_notifications->map(function ($item, $key){
            return DB::table('user')->whereIn('id', function($query){
                $query->select('author')
                      ->from('comment')
                      ->where('id', $item->id_comment);
            });
        });

*/
/*
        $users_collection = $comments_collection->map(function ($item, $key) {
            return User::where('id', '=', $item->author);
        });*/


        /*
        The same as above, but in pure sql

        SELECT id_comment
        FROM comment_notifications
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
            'type' => 'comment',
            'users' => $users_collection,
            'contents' => $comments_collection,
        ]);
    }
}
