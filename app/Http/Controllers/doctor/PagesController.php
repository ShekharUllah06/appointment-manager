<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;


//This class contains the Admin Pannel Routing.

class PagesController extends Controller
{

    public function getDashboard()
    {
        return view('doctor.pages.dashboard');
    }
  
}
