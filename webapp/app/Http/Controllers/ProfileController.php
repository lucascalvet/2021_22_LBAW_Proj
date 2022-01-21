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
    public function show($user_id)
    {
      $user = User::findOrFail($user_id);

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
      $user = User::findOrFail($userId);
      $this->authorize('update', $user);

      return view('pages.edit_profile', [
        'user' => $user,
      ]);
    }

    public function save($userId){
      $user = User::findOrFail($userId);
      $this->authorize('update', $user);

      $user->name = request()->name;
      $user->birthday = request()->birthday;
      $user->email = request()->email;
      $user->description = request()->description;
      $user->password = request()->password;
      $user->phone_number = request()->phone;

      return view('pages.profile', [
        'user' => $user,
      ]);
    }
}
