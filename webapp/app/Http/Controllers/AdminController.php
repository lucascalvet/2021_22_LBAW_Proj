<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Shows the administration area
     *
     * @return Response
     */
    public function show()
    {
      return view('pages.admin_main');
    }

     /**
     * Shows the accounts administration area
     *
     * @return Response
     */
    public function showAccounts()
    {
      return view('pages.admin_accounts');
    }

     /**
     * Shows posts administration area
     *
     * @return Response
     */
    public function showPosts()
    {
      return view('pages.admin_posts');
    }

     /**
     * Shows statistics administration area
     *
     * @return Response
     */
    public function showStatistics()
    {
      return view('pages.admin_statistics');
    }
}
