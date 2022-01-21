<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;

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

  public function save(Request $request, $userId)
  {
    $user = User::findOrFail($userId);
    $this->authorize('update', $user);

    Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'password' => 'nullable|string|min:6|confirmed',
      'email' => ['required', Rule::unique('users')->ignore($userId), 'string', 'email', 'max:255'],
      'phone_number' => 'nullable|numeric',
      'profile_picture' => 'nullable|file|image',//'nullable|file|mimetypes:image/jpeg,image/png',
      'cover_picture' => 'nullable|file|image',//'nullable|file|mimetypes:image/jpeg,image/png',
      'birthday' => 'required|date',
    ])->validate();

    $user->name = $request->name;
    $user->birthday = $request->birthday;
    $user->email = $request->email;
    $user->description = $request->description;
    if(!is_null($request->password)) $user->password = bcrypt($request->password);
    if(!is_null($request->phone_number)) $user->phone_number = $request->phone;
    if(!is_null($request->profile_picture)){
      $imgFile = Image::make($request->profile_picture->getRealPath());

      $imgFile->fit(200)->encode('jpg');

      $hash = md5($imgFile->__toString());
      $path = "media/{$hash}.jpg";
      $imgFile->save(public_path($path));

      $user->profile_picture = $path;
    }
    if(!is_null($request->cover_picture)){
      $imgFile = Image::make($request->cover_picture->getRealPath());
      $imgFile->fit(1700, 200)->encode('jpg');

      $hash = md5($imgFile->__toString());
      $path = "media/{$hash}.jpg";
      $imgFile->save(public_path($path));

      $user->cover_picture = $path;
    }
    $user->save();

    return redirect()->route('profile', [
      'user' => $user->id,
    ]);
  }

  public function destroy($userId)
  {

    $user = User::findOrFail($userId);
    $this->authorize('delete', $user);
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

    foreach ($user->comments as $comment) {
      $comment->id_author = 1;
      $comment->save();
    }

    $user->delete();

    return redirect('login');
  }
}
