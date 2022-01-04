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
      abort_if(is_null($user = User::find($userId)), 404);
      $this->authorize('update', $user);

      return view('pages.edit_profile', [
        'user' => $user,
      ]);
    }

    public function save($userId){
      abort_if(is_null($user = User::find($userId)), 404);
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
