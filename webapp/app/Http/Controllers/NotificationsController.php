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
    public function likes()
    {
        return view('pages.notifications', [
            'type' => 'likes',
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
