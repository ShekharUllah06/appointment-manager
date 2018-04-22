<?php

namespace App\Http\Controllers\Front;

//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;



class helpController extends Controller
{

    public function getHelp(){
       
        $massege = "We are Sorry!!, This Section is Under Construction! Please visit later. You can visit other sections of this site which are almost complete for test purpose.";
        
        return view('front.pages.help', ['massege' => $massege]);

    }
}
