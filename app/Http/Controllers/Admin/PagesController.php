<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\personal_info;
use App\chamber;
use App\education;
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

    /**
     * This function queries db for data and returns chamber records to chamber-view page.
     * 
     * @return array
     */
    public function viewChamberList()
    {
        $auth_user_id = Auth::user()->id;
        
        //query with chamber table for record with Auth::user()->id        
        $chambers = chamber::where('user_id', $auth_user_id)->get(); //

        //if no record found create new blank record           
        if(empty($chambers[0])){
            
            return redirect('admin/settings/chamber/new')
                    ->with('message','No Chamber Data found in database. Please Add a new chamber Record!')
                    ->with('status', 'danger'); 
        }
             
        return view('admin.pages.settings.chamber-view', ['chambers'=>$chambers]);
    }

    /**
     * This function just returns chamber-form view
     * 
     * @return view
     */    
    public function newChamberForm()
    {
            return view('admin.pages.settings.chamber-form');
    }

    /**
     * This function just returns chamber-form view with data to edit on taking 
     * Chamber ID from get request from chamber-view Form.
     * 
     * @return array
     */      
    public function editChamberForm($cId)
    {           $auth_user_id = Auth::user()->id;
                $chamber_id = $cId;
                $chamberFormType = "edit";
                $chamber = chamber::where('user_id', $auth_user_id)->where('chamber_id', $chamber_id)->first();
                
                return view('admin.pages.settings.chamber-form', ['chamber'=>$chamber])->with('chamberFormType', $chamberFormType);
    }
    
    /**
     * 1. This function takes the post data from chamber-form validates them.
     * 2. Then saves them to db. Or create a new record first if post data is new data 
     *    and then saves them to db. And redirects to chamber-view page.
     * 3. If validation fails, its redirects back to previous Form with data and error message.
     * 
     * @return redirest to chamber-form with error message if any.
     */  
    public function saveChamber(Request $request){       
        $auth_user_id = Auth::user()->id;
        $chamber = null;
        
        //Validating chamberfform input data and show error massege if not valid        
        $validator = Validator::make($request->all(),[
            'chamberId' => 'string|required|max:4',
            'institute' => 'string|nullable|max:50',
            'chamber_name' => 'string|required|max:50',
            'telephone_number1' => 'string|nullable|max:12',
            'telephone_number2' => 'string|nullable|max:12',
            'telephone_number3' => 'string|nullable|max:12',
            'mobile_number1' => 'string|nullable|max:12',
            'mobile_number2' => 'string|nullable|max:12',
            'mobile_number3' => 'string|nullable|max:12',
            'city' => 'string|max:50',
            'post_code' => 'string|max:10',
            'thana' => 'string|max:50',
            'district' => 'string|max:50',
            'address' => 'string|max:100',
            ]);
        
        //Validate
        if($validator->fails()){            
            return redirect()
                ->back()
                ->with('message','Please input the Informations Correctly!')
                ->with('status', 'danger')
                ->withInput()
                ->withErrors($validator);
        }
        
        //cheak if data submited as Edit form or New form
        if($request->input('formType') === "edit"){
            
          //getting input chamberId from the form        
            $chamberId = $request->input('chamberId');
            $chamber = chamber::where('user_id', $auth_user_id)->where('chamber_id', $chamberId)->first();
            
        }else{
            
            //create new record            
            $chamber = new chamber;
 
                $chamber->user_id = $auth_user_id;
                $chamber->chamber_id = $request->input('chamberId');

        }      
            
        
            //assign form datas to model fields
            $chamber->institute = $request->input('institute');
            $chamber->chamber_name = $request->input('chamber_name');
            $chamber->telephone_number1 = $request->input('telephone_number1');
            $chamber->telephone_number2 = $request->input('telephone_number2');
            $chamber->telephone_number3 = $request->input('telephone_number3');
            $chamber->mobile_number1 = $request->input('mobile_number1');
            $chamber->mobile_number2 = $request->input('mobile_number2');
            $chamber->mobile_number3 = $request->input('mobile_number3');
            $chamber->city = $request->input('city');
            $chamber->post_code = $request->input('post_code');
            $chamber->thana = $request->input('thana');
            $chamber->district = $request->input('district');
            $chamber->address = $request->input('address');
            
            try{
            
                //save assigned data to the chamber table            
                $chamber->save();
            
            }catch(\Illuminate\Database\QueryException $ex){
                
                return redirect()
                ->back()
                ->with('message','Warning!! Please check that the chamber Id that you have provided is unique, "Chambr ID" and "Chamber Name" fields are reqired.  And all other data(optional) are of desired type. Then try again!')
                ->with('status', 'danger')
                ->withInput();
            }
            
            return redirect()
                    ->route('adminChamber')
                    ->with('message','Chamber Information Saved!')
                    ->with('status', 'success');
    }
    
    
    /**
     * This function deletes chamber record from database table chamber with primary key passed from chamber-form. 
     * 
     * 
     * @return redirect
     */    
    public function removeChamber($cId)
    {           $auth_user_id = Auth::user()->id;
                $chamber_id = $cId;
                $chamberFormType = "edit";
                
                $chamber = chamber::where('user_id', $auth_user_id)->where('chamber_id', $chamber_id)->first();
                
                $chamber->delete();
                
                    return redirect()
                    ->route('adminChamber')
                    ->with('message','Chamber Information Removed Seccessfully!')
                    ->with('status', 'success');
    }

    
    
    /**
     * This function queries db for data and returns education records to education-view page.
     * 
     * @return array
     */
    public function viewEducationList()
    {
        $auth_user_id = Auth::user()->id;
        
        //query with education table for record with Auth::user()->id        
        $educations = education::where('user_id', $auth_user_id)->get(); //

        //if no record found create new blank record           
        if(empty($educations[0])){
            
            return redirect('admin/settings/education/new')
                    ->with('message','No Education Data found in database. Please Add a new Education Record!')
                    ->with('status', 'danger'); 
        }
             
        return view('admin.pages.settings.education-view', ['educations'=>$educations]);
    }

    /**
     * This function just returns education-form view
     * 
     * @return view
     */    
    public function newEducationForm()
    {
            return view('admin.pages.settings.education-form');
    }
    
    /**
     * This function just returns education-form view with data to edit on taking 
     * 'Degree Name' from get request from education-view Form.
     * 
     * @return array
     */      
    public function editEducationForm($degreeName)
{       $auth_user_id = Auth::user()->id;
        $degree_name = $degreeName;
        $educationFormType = "edit";
        $education = education::where('user_id', $auth_user_id)->where('degree_name', $degree_name)->first();

        return view('admin.pages.settings.education-form', ['education'=>$education])->with('educationFormType', $educationFormType);
    }
    
       /**
     * 1. This function takes the post data from education-form validates them.
     * 2. Then saves them to db. Or create a new record first if post data is new data 
     *    and then saves them to db. And redirects to education-view page.
     * 3. If validation fails, its redirects back to previous Form with data and error message.
     * 
     * @return redirest to education-form with error message if any.
     */  
    public function saveEducation(Request $request){       
        $auth_user_id = Auth::user()->id;
        $education = null;
        
        //Validating education form input data and show error massege if not valid        
        $validator = Validator::make($request->all(),[
            'instituteName' => 'string|nullable|max:50',
            'degreeName' => 'string|nullable|max:50',
            'passYear' => 'string|nullable|max:10',
            ]);
        
        //Validate
        if($validator->fails()){            
            return redirect()
                ->back()
                ->with('message','Please input the Informations Correctly!')
                ->with('status', 'danger')
                ->withInput()
                ->withErrors($validator);
        }
        
        //cheak if data submited as Edit form or New form
        if($request->input('formType') === "edit"){
            
          //getting input degreeName from the form        
            $degreeName = $request->input('degreeName');
            $education = education::where('user_id', $auth_user_id)->where('degree_name', $degreeName)->first();
            
        }else{
            
            //create new record            
            $education = new education;
 
            $education->user_id = $auth_user_id;
            $education->degree_name = $request->input('degreeName');

        }      
            
        
            //assign form datas to model fields
            $education->institute_name = $request->input('instituteName');
            $education->pass_year = $request->input('passYear');

            
            try{
            
                //save assigned data to the personal_info table            
                $education->save();
            
            }catch(\Illuminate\Database\QueryException $ex){
                
                return redirect()
                ->back()
                ->with('message','Warning!! Please check that the degree_name that you have provided is unique, "Degree Name" field is reqired.  And all other data(optional) are of desired type. Then try again!')
                ->with('status', 'danger')
                ->withInput();
            }
            
            return redirect()
                    ->route('adminEducation')
                    ->with('message','Education Information Saved!')
                    ->with('status', 'success');
    }
    
 
    /**
     * This function deletes education record from database table education with primary key passed from education-form. 
     * 
     * 
     * @return redirect
     */      
    public function removeEducation($degreeName)
{       $auth_user_id = Auth::user()->id;
        $degree_name = $degreeName;
        $educationFormType = "edit";
        
        $education = education::where('user_id', $auth_user_id)->where('degree_name', $degree_name)->first();
        
        $education->delete();
                    return redirect()
                    ->route('adminEducation')
                    ->with('message','Education Information Removed Seccessfully!')
                    ->with('status', 'success');
    }
    
    
    /**
    *This function queries personal-info table with user_id taken from Auth::user()->id.
    *and returns the personal-info with the query data.
    *
     *  @return type array
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
        return view('admin.pages.settings.personal-info', ['personal_info'=>$personal_info]);
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
            'dateOfBirth' => 'date|nullable|required',
            'genderName' => 'numeric|nullable|required|max:1',
            'homeTown' => 'string|nullable|required|max:50',
            'countryName' => 'string|nullable|required|max:50',
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
            $personal_info->date_of_birth = $request->input('dateOfBirth');
            $personal_info->gender = $request->input('genderName');
            $personal_info->home_town = $request->input('homeTown');
            $personal_info->country = $request->input('countryName');
            $personal_info->address = $request->input('address');
            
            //save assigned data to the personal_info table            
            $personal_info->save();
            
            //return view to personal info page with personal_info query object.            
            return redirect()
                    ->route('adminPersonalInfo', ['personal_info'=>$personal_info])
                    ->with('message','Personal Information Saved!')
                    ->with('status', 'success');
    }
    
    public function viewWorkHistory()
    {
        return view('admin.pages.settings.work-history');
    }
    
}
