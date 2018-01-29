<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

//This class contains the Patient Pannel Routing

class PagesController extends Controller
{

    public function getDashboard()
    {
        if(Auth::user()->userType !== 2){ //Check if user is Doctor or die!
            Auth::logout();
            return redirect('/login');
        }
        
        return view('patient.dashboard');
    }
  
}
