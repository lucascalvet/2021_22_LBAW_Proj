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

  public function save($userId)
  {
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

  public function destroy($userId)
  {
    $user = User::findOrFail($userId);
    foreach ($user->groups as $group) {
      if ($group->members->contains($user)) {
        $group->members()->detach($user);
        if ($group->moderators->contains($user)) {
          $group->moderators()->detach($user);
        }
      }
    }
    foreach ($user->contents as $content) {
      (new ContentController)->destroy($content->id);
    }

    foreach ($user->likes as $like) {
      $like->delete();
    }

    foreach ($user->comments as $comment) {
      $comment->id_author = 1;
      $comment->save();
    }

    

    $user->delete();

    return redirect('login');
  }
}
