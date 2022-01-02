<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show()
    {
      return view('pages.search');
    }

  //   {{-- public function search(Request $request){
  //     // Get the search value from the request
  //     $search = $request->input('search');
  
  //     // Search in the title and body columns from the posts table
  //     $posts = User::query()
  //         ->where('name', 'LIKE', "%{$search}%")
  //         ->orWhere('email', 'LIKE', "%{$search}%")
  //         ->get();
  
  //     // Return the search view with the resluts compacted
  //     return view('search', compact('users'));
  // } --}}
}
