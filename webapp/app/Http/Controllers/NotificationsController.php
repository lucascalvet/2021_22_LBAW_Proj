<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /**
     * Shows the all section on the Notifications page
     *
     * @return Response
     */
    public function all(Request $request)
    {
        //this gives us the currently logged in user
        $user = $request->user();

        $notifications = $user->notifications->sort(function ($a, $b) {
            $date_a = $a->date();
            $date_b = $b->date();
            if ($date_a == $date_b) {
                return 0;
            }
            return ($date_a > $date_b) ? -1 : 1;
        });

        return view('pages.notifications', [
            'notifications' => $notifications,
        ]);
    }

    /**
     * Shows the friend requests section on the Notifications page
     *
     * @return Response
     */
    public function friends(Request $request)
    {

        //this gives us the currently logged in user
        $user = $request->user();

        $notifications = $user->notifications->filter(function ($value) {
            return !is_null($value->friend_request());
        })->sort(function ($a, $b) {
            $date_a = $a->date();
            $date_b = $b->date();
            if ($date_a == $date_b) {
                return 0;
            }
            return ($date_a > $date_b) ? -1 : 1;
        });

        return view('pages.notifications', [
            'notifications' => $notifications,
        ]);
    }

    /**
     * Shows the likes section on the Notifications page
     *
     * @return Response
     */
    public function likes(Request $request)
    {

        //this gives us the currently logged in user
        $user = $request->user();

        $notifications = $user->notifications->filter(function ($value) {
            return !is_null($value->like());
        })->sort(function ($a, $b) {
            $date_a = $a->date();
            $date_b = $b->date();
            if ($date_a == $date_b) {
                return 0;
            }
            return ($date_a > $date_b) ? -1 : 1;
        });

        return view('pages.notifications', [
            'notifications' => $notifications,
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

        $notifications = $user->notifications->filter(function ($value) {
            return !is_null($value->comment());
        })->sort(function ($a, $b) {
            $date_a = $a->date();
            $date_b = $b->date();
            if ($date_a == $date_b) {
                return 0;
            }
            return ($date_a > $date_b) ? -1 : 1;
        });

        return view('pages.notifications', [
            'notifications' => $notifications,
        ]);
    }
}
