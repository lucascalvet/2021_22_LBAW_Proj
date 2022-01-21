<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Shows the Home page
     *
     * @return Response
     */
    public function show(Request $request) {
      $contents = \App\Models\Content::orderBy('publishing_date', 'desc');

      if (!Auth::check() || !Auth::user()->isAdmin()) {
        $contents = $contents->where('id_creator', '<>', 1);
      }

      $contents = $contents->get();
      if(Auth::check() && !Auth::user()->isAdmin()){
        $contents = $contents->filter(function ($content, $key){
          return $content->creator == Auth::user() || $content->creator->isFriendOf(Auth::user()->id);
        });
      }

      $contents = $contents->filter(function ($value, $key) {
      if ($value->contentable instanceof \App\Models\TextContent) {
        return $value->contentable->isRoot();
      }
        return true;
      });

      return view('pages.home', [
        'contents' => $contents,
      ]);
    }
}

