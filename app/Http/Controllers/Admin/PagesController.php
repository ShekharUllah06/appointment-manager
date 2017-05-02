<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


//This class contains the Admin Pannel Routing

class PagesController extends Controller
{

    public function getDashboard()
    {
        return view('admin.pages.dashboard');
    }
  
}
