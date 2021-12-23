<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
     /**
     * Shows the profile
     *
     * @return Response
     */
    public function show()
    {
      return view('pages.profile');
    }
}