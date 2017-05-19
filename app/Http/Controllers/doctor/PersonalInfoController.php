<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\personal_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PersonalInfoController extends Controller
{
    
    /**
    *This function queries personal-info table with user_id taken from Auth::user()->id.
    *and returns the personal-info with the query data.
    *
     *  @return type array.
    */
    public function viewPersonalInfo()                        
    {
        $auth_user_id = Auth::user()->id;
        
        //query with personal_info table for record with Auth::user()->id        
        $personal_info = personal_info::find($auth_user_id); //change first() if posible
 
        //if no record found create new blank record          
        if(empty($personal_info)){
            $personal_info = new personal_info;
            $personal_info->id = $auth_user_id;
            
            //save assigned data to the personal_info table             
            $personal_info->save();
        

            
            $personal_info = personal_info::find($auth_user_id);;
        }
        
        //return view to personal info page with personal_info query object.        
        return view('doctor.pages.settings.personal-info', ['personal_info'=>$personal_info]);
    }
     
    
    /**
    *This function updates the input data from presonal-info page form too database table personal_info.
    *It validates the data before updating,
    *
     *  @return type array
    */
    
    public function savePersonalInfo(Request $request)
    {
        
        //Validating personal-info form input data and show error massege if not valid       
        $validator = Validator::make($request->all(),[
            'dateOfBirth' => 'date|required',
            'genderName' => 'numeric|required|max:1',
            'homeTown' => 'string|required|max:50',
            'countryName' => 'string|required|max:50',
            'address' => 'string|nullable|max:100',]);
        
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
      
            //query with personal_info table for record with input id        
            $personal_info = personal_info::find($user_id);
            
            //assign form datas to model fields   
            
            if(Request::hasFile('profilePicture')){
                $file = Request::file('profilePicture');
            }
//            $profilePicture = \Illuminate\Support\Facades\Input::file('profilePicture');
//            $filename = time() . '.' . $profilePicture->getClientOriginalExtension();
//            $path = public_path('profilepics/' . $filename);
//            Image::make($profilePicture->getRealPath())->resize(200,200)->save($path);
//            $user->$profilePicture = $filename;
            
            $personal_info->imageUrl = $request->input('');
            $personal_info->date_of_birth = $request->input('dateOfBirth');
            $personal_info->gender = $request->input('genderName');
            $personal_info->home_town = $request->input('homeTown');
            $personal_info->country = $request->input('countryName');
            $personal_info->address = $request->input('address');
            
            try{  
                //save assigned data to the personal_info table            
                $personal_info->save();
            }catch(\Illuminate\Database\QueryException $ex){
                
                return redirect()
                ->back()
                ->with('message','Warning!! All fields are reqired.  And all data are of desired type. Then try again!')
                ->with('status', 'danger')
                ->withInput();
            }            
            //return view to personal info page with personal_info query object.            
            return redirect()
                    ->route('doctorPersonalInfo', ['personal_info'=>$personal_info])
                    ->with('message','Personal Information Saved!')
                    ->with('status', 'success');
    }
    
}
