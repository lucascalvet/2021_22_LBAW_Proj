<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /**
     * Shows the notifications
     *
     * @return Response
     */
    public function show()
    {
      return view('pages.notifications');
    }
}
