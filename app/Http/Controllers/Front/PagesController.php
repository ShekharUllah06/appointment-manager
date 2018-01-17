<?php

namespace App\Http\Controllers\Front;

//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Traits\zakiPrivateLibTrait;
use App\Models\User;
use App\Models\personal_info;
use App\Models\education;
use App\Models\work_history;
use App\Models\specialty;


class PagesController extends Controller
{
    use zakiPrivateLibTrait;
    
    public function getHome()
    {

        return view('front.pages.home');

    }
    
    
    public function getDoctorPublicProfile($doctorID, $calenderMonth = null){  //Needs validation for $doctorID and $calenderMonth
        //declear variables
        $calender = [];
        
        //Query the Tables
        $user = User::select('id', 'first_name', 'last_name')->where('id', $doctorID)->first();
        $personal_info = personal_info::select('imageUrl')->where('id', $doctorID)->first();
        $educations = education::select('degree_name', 'pass_year', 'institute_name')->where('user_id', $doctorID)->get();
        $work_histories = work_history::where('user_id', $doctorID)->get();
        $specialties = specialty::where('user_id', $doctorID)->get();


        $calender = $this->doctorCalender($doctorID, $calenderMonth);

        
        return view('front.pages.doctor_public_profile', ['calender' => $calender, 'user' => $user, 'educations' => $educations, 'work_histories' => $work_histories, 'specialties' => $specialties, 'personal_info' => $personal_info]);

    }
}
