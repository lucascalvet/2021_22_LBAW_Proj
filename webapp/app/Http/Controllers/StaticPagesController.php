<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function showFAQ()
    {
        return view('static.faq');
    }

    public function showFeatures()
    {
        return view('static.features');
    }

    public function showContacts()
    {
        return view('static.contacts');
    }

    public function showAbout()
    {
        return view('static.about');
    }
}
