<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


//This class contains the Doctor Pannel Routing.

class PagesController extends Controller
{

    public function getDashboard()
    {
        if(Auth::user()->userType !== 1){ //Check if user is Doctor or die!
            Auth::logout();
            return redirect('/login');
        }
        return view('doctor.pages.dashboard');
    }
  
}
