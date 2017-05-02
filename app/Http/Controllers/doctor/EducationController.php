<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class EducationController extends Controller
{
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

        //if no record found return to privious page with error message           
        if(empty($educations[0])){
            
            return redirect()
                    ->route('adminEducationNew')
                    ->with('message','No Education Data found in database. Please Add a new Education Record!')
                    ->with('status', 'danger'); 
        }
             
        return view('doctor.pages.settings.education-view', ['educations'=>$educations]);
    }

    /**
     * This function just returns education-form view
     * 
     * @return view
     */    
    public function newEducationForm()
    {
            return view('doctor.pages.settings.education-form');
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

        return view('doctor.pages.settings.education-form', ['education'=>$education])->with('educationFormType', $educationFormType);
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
        
        $education = education::where('user_id', $auth_user_id)->where('degree_name', $degree_name)->first();
        
        $education->delete();
                    return redirect()
                    ->route('adminEducation')
                    ->with('message','Education Information Removed Seccessfully!')
                    ->with('status', 'success');
    }
 
}
