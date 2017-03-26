<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\DB;
use App\personal_info;
use Validator;
use Illuminate\Support\Facades\Auth;


//This class contains the Admin Pannel Routing

class PagesController extends Controller
{

    public function getDashboard()
    {
        return view('admin.pages.dashboard');
    }
    
    public function viewSchedule()
    {
        return view('admin.pages.schedule');
    }
    
    	public function viewChamber()
    {
        return view('admin.pages.settings.chamber');
    }
    
    	public function viewEducalion()
    {
        return view('admin.pages.settings.education');
    }
    
    
    
    /**
    *1. This function queries the database table personal_info with id taken from Auth::user()->id database table.
    *   If record found then it queries the database table personal_info with id taken from Auth::user()->id database table again
    *   returns the newly created blank record to the personal-info page form.
    * 
    *2.If data record is not found it creates a new blank record with id only in database table personal_info.
    *   Then it queries the database table personal_info with id taken from Auth::user()->id database table again
    *   returns the newly created blank record to the personal-info page form.
    *
    */
    
    public function viewPersonalInfo()                        
    {
        $auth_user_id = Auth::user()->id;
        
    //query with personal_info table for record with Auth::user()->id
        
        $personal_info = personal_info::find($auth_user_id); //change first() if posible
//  
    //if no record found create new blank record   
        
        if(empty($personal_info)){
            $personal_info = new personal_info;
            $personal_info->id = $auth_user_id;
            
    //save assigned data to the personal_info table 
            
            $personal_info->save();
        

            
            $personal_info = personal_info::find($auth_user_id);;
        }
    //return view to personal info page with personal_info query object.
        
        return view('admin.pages.settings.personal-info', ['personal_info'=>$personal_info]);
    }
   
    
    
    /**
    *This function updates the input data from presonal-info page form too database table personal_info.
    *It validates the data before updating,
    *
    */
    
    public function savePersonalInfo(Request $request)
    {
        
    //Validating personal-info form input data and show error massege if not valid
        
        $validator = Validator::make($request->all(),[
            'dateOfBirth' => 'required',
            'genderName' => 'required|max:1',
            'homeTown' => 'required|max:50',
            'countryName' => 'required|max:50',
            'address' => 'max:100',]);
        
        if($validator->fails()){            
            return redirect()
                ->back()
                ->with('message','Please input the Informations Correctly!')
                ->with('status', 'danger')
                ->withInput()
                ->withErrors($validator);
        }
        
    //getting input id from the form
        
        $user_id = $request->input('userId');
        
//      try{  
      
    //query with personal_info table for record with input id
        
            $personal_info = personal_info::find($user_id);
            
    //assign form datas to model fields
            
            $personal_info->date_of_birth = $request->input('dateOfBirth');
            $personal_info->gender = $request->input('genderName');
            $personal_info->home_town = $request->input('homeTown');
            $personal_info->country = $request->input('countryName');
            $personal_info->address = $request->input('address');
            
    //save assigned data to the personal_info table
            
            $personal_info->save();
            
//        }
    //return view to personal info page with personal_info query object.
            
                return view('admin.pages.settings.personal-info', ['personal_info'=>$personal_info])->with('message', "Saved Successfully!!")->with('status', 'danger');

    }
    
    public function viewWorkHistory()
    {
        return view('admin.pages.settings.work-history');
    }
    
}
