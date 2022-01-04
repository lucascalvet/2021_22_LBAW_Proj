<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotController extends Controller
{
    //
    public function show()
    {
      return view('auth.recoverPassword');
    }

}
