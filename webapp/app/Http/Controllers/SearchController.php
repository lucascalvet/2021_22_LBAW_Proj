<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class SearchController extends Controller
{
    public function show()
    {
      return view('pages.search');
    }

     public function search(){

      $search = request()->query('search');

      if($search){
        $users = User::where('name', 'LIKE', "%{$search}%")->orWhere('email', 'LIKE', "%{$search}%")->get();

        return view('pages.search', [
          'users' => $users,
        ]);
      }
      else{
        return view('pages.search', ['users' => []]);
      }


  }
}
