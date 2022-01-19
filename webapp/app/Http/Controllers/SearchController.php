<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Content;

class SearchController extends Controller
{
     public function searchUsers(){

      $search = request()->query('search');

      if($search){
        $users = User::where('name', 'ILIKE', "%{$search}%")->orWhere('username', 'ILIKE', "%{$search}%")->orWhere('email', 'ILIKE', "%{$search}%")->get();

        return view('pages.search', [
          'users' => $users,
        ]);
      }
      else{
        return view('pages.search');
      }
  }

  public function searchPosts(){

    $search = request()->query('search');

    if($search){
      //$posts = MediaContent::where('description', 'LIKE', "%{$search}%")->get();

      $posts = Content::whereRaw("tsvectors @@ plainto_tsquery('english', '{$search}')")->orderByRaw("ts_rank(tsvectors, plainto_tsquery('english', '{$search}')) DESC")->get();

      return view('pages.search', [
        'posts' => $posts,
      ]);
    }
    else{
      return view('pages.search');
    }
  }

}
