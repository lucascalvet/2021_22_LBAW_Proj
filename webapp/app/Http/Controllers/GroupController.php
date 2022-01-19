<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\GroupModerator;
use App\Models\User;

class GroupController extends Controller
{
  public function showHub()
  {
    return view('pages.group_hub');
  }

  public function show($id)
  {
    abort_if(is_null($group = Group::find($id)), 404);
    //$this->authorize('view', $group);

    return view('pages.group', ['id' => $group->id]);
  }

  public function create()
  {
    return view('pages.group_create');
  }

  public function edit($id)
  {
    abort_if(is_null($group = Group::find($id)), 404);
    //$this->authorize('update', $group);
    return view('pages.group_edit', ['id' => $group->id]);
  }

  protected function validator(Request $request)
  {
    return $request->validate([
      'name' => 'required|string|max:255',
      'description' => 'required|string|max:64000'
    ]);
  }

  public function store(Request $request)
  {
    //this gives us the currently logged in user
    $user = $request->user();

    //$valid_request = $this->validator($request);

    $group = new Group;
    $group->name = $request->name;
    $group->description = $request->description;

    $group->save();

    $member = new GroupMember;
    $member->id_group = $group->id;
    $member->id_user_member = $user->id;
    $member->save();
    $moderator = new GroupModerator;
    $moderator->id_group = $group->id;
    $moderator->id_user_moderator = $user->id;
    $moderator->save();

    return redirect()->route('group.show', ['id' => $group->id]);
  }

  public function update(Request $request, $id)
  {
    $group = Group::find($id);
    $group->name = $request->name;
    $group->description = $request->description;

    $group->save();

    return redirect()->route('group.show', ['id' => $group->id]);
  }

  public function destroy($id)
  {

    abort_if(is_null($group = Group::find($id)), 404);
    //$this->authorize('delete', $content);


    foreach ($group->contents as $content) {
      $content->group()->dissociate();
      $content->save();
    }

    $group->members()->detach();
    $group->moderators()->detach();

    $group->delete();

    return redirect()->route('groups');
  }

  public function memberJoin($id, $user)
  {
    $group = Group::find($id);
    $group->members()->attach($user);

    return redirect()->route('group.show', ['id' => $group->id]);
  }

  public function memberLeave($id, $user)
  {
    $group = Group::find($id);
    if ($group->moderators->contains(User::find($user))) {
      $group->moderators()->detach($user);
    }
    $group->members()->detach($user);

    if ($group->moderators()->count() == 0) {
      $this->destroy($group->id);
      return redirect()->route('groups');
    }

    return redirect()->route('group.show', ['id' => $group->id]);
  }

  public function modJoin($id, $user)
  {
    $group = Group::find($id);
    if (!($group->members->contains(User::find($user)))) {
      $group->members()->attach($user);
    }
    $group->moderators()->attach($user);

    return redirect()->route('group.show', ['id' => $group->id]);
  }

  public function modLeave($id, $user)
  {
    $group = Group::find($id);
    $group->moderators()->detach($user);
    if ($group->moderators()->count() == 0) {
      $this->destroy($group->id);
      return redirect()->route('groups');
    }

    return redirect()->route('group.show', ['id' => $group->id]);
  }
}
