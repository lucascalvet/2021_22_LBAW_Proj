<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class ProfileController extends Controller
{
     /**
     * Shows the profile
     *
     * @return Response
     */
    public function show($userId)
    {
      $user = User::find($userId);

      return view('pages.profile', [
        'user' => $user,
      ]);
    }

     /**
     * Shows the profile
     *
     * @return Response
     */
    public function showEdit($userId)
    {
      $user = User::find($userId);

      return view('pages.edit_profile', [
        'user' => $user,
      ]);
    }
}
