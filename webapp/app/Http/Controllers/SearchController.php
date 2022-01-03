<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\MediaContent;

class SearchController extends Controller
{
     public function searchUsers(){

      $search = request()->query('search');

      if($search){
        $users = User::where('name', 'LIKE', "%{$search}%")->orWhere('username', 'LIKE', "%{$search}%")->orWhere('email', 'LIKE', "%{$search}%")->get();

        return view('pages.search', [
          'users' => $users,
          'type' => 'user',
        ]);
      }
      else{
        return view('pages.search', ['users' => [], 'type' => 'user']);
      }
  }

  public function searchPosts(){

    $search = request()->query('search');

    if($search){
      $posts = MediaContent::where('description', 'LIKE', "%{$search}%")->get();

      return view('pages.search', [
        'posts' => $posts,
        'type' => 'post',
      ]);
    }
    else{
      return view('pages.search', ['posts' => [], 'type' => 'post']);
    }
  }

}
