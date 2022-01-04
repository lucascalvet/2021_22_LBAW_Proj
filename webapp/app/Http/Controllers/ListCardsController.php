<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListCardsController extends Controller
{
    //
    public function show()
    {
      return view('partials.listCards',['username'=>'John Doe', 'description'=>'Studied at FEUP, currently working on fixing is life.', 'comment'=>'Son of a gun','days_ago'=>'yesterday']);
    }
}
