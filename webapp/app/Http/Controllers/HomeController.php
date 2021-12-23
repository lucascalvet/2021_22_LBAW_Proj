<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Shows the Home page
     *
     * @return Response
     */
    public function show()
    {
      return view('pages.home');
    }
}

