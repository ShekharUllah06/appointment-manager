<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;


//This class contains the Patient Pannel Routing

class PagesController extends Controller
{

    public function getDashboard()
    {
        return view('patient.dashboard');
    }
  
}
