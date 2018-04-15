<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


//This class contains the Doctor Pannel Routing.

class AccountSettingsController extends Controller
{

    public function showAccountSettings(Request $request)
    {
        
        //Validating userID form input data and show error massege if not valid       
        $validator = Validator::make($request->all(),[
            'userId' => 'alpha_num|max:11',]);        
        
        if($validator->fails()){
            return redirect()
                ->back()
                ->with('message','User not Valid')
                ->with('status', 'warning')
                ->withInput();
        }
        //Query User Table
       $userInfo = User::where('id', $request['userID'])->select('id', 'first_name', 'last_name', 'email')->first();
       
       //Check if passed user id is logged in
        if($request['userID'] == Auth::user()->id){
            return view('doctor.account.accountSettings', ['userInfo' => $userInfo]);
        }
        
        return redirect()
                ->back()
                ->with('message','User not Valid')
                ->with('warning', 'warning')
                ->withInput();
    }
    
    
    
    public function changeInformation(Request $request){
        
        //Validating Account Info form input data and show error massege if not valid       
        $validator = Validator::make($request->all(),[
            'userId' => 'alpha_num|max:10',
            'firstName' => 'string|max:10',
            'lastName' => 'string|max:10',
            'email'=> 'email|max:60',
            ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->with('message','Data not Valid! Please re-check type Data.')
                ->with('warning', 'warning')
                ->withInput();
        }
        
        //Query User Table
       $userInfo_1 = User::find($request['userID']);

if(Auth::user()->id == 1){
    die();
}
       //Check if passed user id is logged in
        if($request['userID'] == Auth::user()->id){
            $userInfo_1->first_name = $request['firstName'];
            $userInfo_1->last_name = $request['lastName'];
            $userInfo_1->email = $request['email'];

            try{  
            //save assigned data to the User table 
                               
                $userInfo_1->save();
                
            }catch(\Illuminate\Database\QueryException $ex){
                return redirect()
                ->back()
                ->with('message','Warning!! All fields are reqired.  And all data are of desired type. Then try again!')
                ->with('status', 'danger')
                ->withInput();
            }            
            
        }
        //return view to personal info page with personal_info query object.            
//                   return view('doctor.account.accountSettings', ['userInfo' => $userInfo]);
        return redirect()
                ->route('doctor.dashboard')
                ->with('message','Data Saved')
                ->with('status', 'success')
                ->withInput();
    }
  
}
