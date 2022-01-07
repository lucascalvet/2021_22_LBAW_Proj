<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function showHub()
    {
      return view('pages.group_hub');
    }
}
