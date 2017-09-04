<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\personal_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Image;
use Carbon;

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
        //if no avatar present; save default avatar to DB
        if(empty($personal_info->imageUrl)){
            $personal_info->imageUrl = "default.png";
            $personal_info->save();  
        }
        //return view to personal info page with personal_info query object.        
        return view('doctor.pages.settings.personal-info', ['personal_info'=>$personal_info]);
    }
     
    
    /**
    *This function updates the input data from personal-info page form too database table personal_info.
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
            'address' => 'string|nullable|max:100',
            'profilePicture' => 'nullable|max:255',]);
        
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
                    ->route('doctorPersonalInfo')
                    ->with('message','Personal Information Saved!')
                    ->with('status', 'success');
    }
     
    
    /**
    *This function updates the input file/avatar assigned name from personal-info page form too
    *database table personal_info and upload the file to public/uploads/avatars/. folder.
    *It validates the data before updating,
    *
     *  @return type array
    */
    
    public function saveAvatar(Request $request)
    {
        //
        if($request->hasFile('profilePicture') && $request->file('profilePicture')->isValid()){
            $user_id = $request->input('userId');
            $avatar = $request->file('profilePicture');
            
            //Build input the for validation
            $fileArray = array('image' => $avatar);
            
            //Tell the Validator that this file should be an image with type and size
            $rulesArray = array('image' => 'mimes:jpeg,jpg,png,gif|max:3000');
            
            //Now pass the input and rules in to the validator
            $validator = Validator::make($fileArray, $rulesArray);
            
            if($validator->fails()){
              return redirect()
                    ->back()
                    ->with('message','Warning!! Make sure that the Image is a vilid image file type and of any of the jpeg, jpg, gif, png type/extension and it is of no larger then 3 Mega Bytes. Then try again!')
                    ->with('status', 'danger')
                    ->withInput();  
            }else{
                $fileName = $user_id .".". $avatar->getClientOriginalExtension();
                //Resize and upload image ith image intervention
                Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $fileName)); 


                //query with personal_info table for record with input id        
                $personal_info = personal_info::find($user_id);
                $personal_info->imageUrl = $fileName;

                try{  
                    //save assigned image name to the DB personal_info table            
                    $personal_info->save();
                }catch(\Illuminate\Database\QueryException $ex){

                    return redirect()
                    ->back()
                    ->with('message','Warning!! There were some problem saving image/avatar to the Database. Please try again! If the problem persist Please contact your site Administrator.')
                    ->with('status', 'danger')
                    ->withInput();
                }  
            }
            
            return redirect()
             ->route('doctorPersonalInfo')
            ->with('message','Avatar Saved!')
            ->with('status', 'success');          
            
        }else{
            return redirect()
                ->back()
                ->with('message','Stop! Please select an Image by clicking Browse button and make sure that the file exists and is a valid image file.')
                ->with('status', 'danger')
                ->withInput();
        }                
 
    }
    
     
    
}
