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
         //this gives us the currently logged in user
         $user = $request->user();

         //likes
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

        $content_likes = DB::table('content_like')->whereIn('id', function ($query) use($user) {
            $query->select('id_like')
            ->from('like_notification')
            ->whereIn('id_notification', function ($query) use($user) {
                $query->select('id')
                    ->from('notification')
                    ->where('id_user', '=', $user->id);
        });
        })->get();

        //friend requests
        $friend_requests = DB::table('friend_request')->whereIn('id', function ($query) use($user) {
            $query->select('id_friend_request')
            ->from('friend_request_notification')
            ->whereIn('id_notification', function ($query) use($user) {
                $query->select('id')
                    ->from('notification')
                    ->where('id_user', '=', $user->id);
            });
        })->get();

        $users_collection2 = DB::table('users')->whereIn('id', function($query) use($user){
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

        //comments
        $comments_notifications = CommentNotification::whereIn('id_notification', function ($query) use($user) {
            $query->select('id')
                ->from('notification')
                ->where('id_user', '=', $user->id);
        })->get();

        $comments_collection = DB::table('comment')->whereIn('id', function ($query) use($user) {
            $query->select('id_comment')
                ->from('comment_notification')
                ->whereIn('id_notification', function ($query) use($user) {
                    $query->select('id')
                        ->from('notification')
                        ->where('id_user', '=', $user->id);
                });
        })->get();

        $users_collection3 = DB::table('users')->whereIn('id', function ($query) use($user) {
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


        //combine user collections
        $users_collection2->each(function($element) use (&$users_collection) {
            $users_collection->push($element);
        });

        $users_collection3->each(function($element) use (&$users_collection) {
            $users_collection->push($element);
        });

        return view('pages.notifications', [
            'type' => 'all',
            'users' => $users_collection,
            'contents' => $contents_collection,
            'content_likes' => $content_likes,
            'friend_requests' => $friend_requests,
            'comments' => $comments_collection,
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
        $friend_requests = $user->friendRequests;
        $users = array();
        foreach($friend_requests as $friend_request){
            array_push($users, User::findOrFail($friend_request->id_sender));
        }
        // //retrieves all friend requests
        // $friend_requests = DB::table('friend_request')->whereIn('id', function ($query) use($user) {
        //     $query->select('id_friend_request')
        //     ->from('friend_request_notification')
        //     ->whereIn('id_notification', function ($query) use($user) {
        //         $query->select('id')
        //             ->from('notification')
        //             ->where('id_user', '=', $user->id);
        //         });
        // })->get();

        // //retrieves all users that sent a friend request
        // $users_collection = DB::table('users')->whereIn('id', function($query) use($user){
        //     $query->select('id_sender')
        //         ->from('friend_request')
        //         ->whereIn('id', function ($query) use($user) {
        //         $query->select('id_friend_request')
        //         ->from('friend_request_notification')
        //         ->whereIn('id_notification', function ($query) use($user) {
        //             $query->select('id')
        //                 ->from('notification')
        //                 ->where('id_user', '=', $user->id);
        //             });
        //         });
        // })->get();

        return view('pages.notifications', [
            'type' => 'friend_request',
            'users' => $users,
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

        //retrieves all users that generated like notifications
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

        $contents_collection = array();

        //retrieves all contents that generated previous like notifications
        foreach($users_collection as $us){

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

        //retrieves all content_likes that generated previous likes notifications
        $content_likes = DB::table('content_like')->whereIn('id', function ($query) use($user) {
            $query->select('id_like')
            ->from('like_notification')
            ->whereIn('id_notification', function ($query) use($user) {
                $query->select('id')
                    ->from('notification')
                    ->where('id_user', '=', $user->id);
                });
        })->get();

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

        //retrieves all comment_notifications for the logged user
        $comments_notifications = CommentNotification::whereIn('id_notification', function ($query) use($user) {
            $query->select('id')
                ->from('notification')
                ->where('id_user', '=', $user->id);
        })->get();

        //retrieves all the actual comments that generated previous notifications
        $comments_collection = DB::table('comment')->whereIn('id', function ($query) use($user) {
            $query->select('id_comment')
            ->from('comment_notification')
            ->whereIn('id_notification', function ($query) use($user) {
                $query->select('id')
                    ->from('notification')
                    ->where('id_user', '=', $user->id);
                });
        })->get();

        //retrieves the users that generated the notifications
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

        return view('pages.notifications', [
            'type' => 'comment',
            'users' => $users_collection,
            'comments' => $comments_collection,
        ]);
    }
    /*
    public function toggleFilter($url){
        return redirect()->route('notifications.likes');
    }
    */
}
