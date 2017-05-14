<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\chamber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ChamberController extends Controller
{
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

        //if no record found return to privious page with error message           
        if(empty($chambers[0])){
            
            return redirect()
                    ->route('adminChamberNew')
                    ->with('message','No Chamber Data found in database. Please Add a new chamber Record!')
                    ->with('status', 'danger'); 
        }
             
        return view('doctor.pages.settings.chamber-view', ['chambers'=>$chambers]);
    }

    
    /**
     * This function just returns chamber-form view
     * 
     * @return view
     */    
    public function newChamberForm()
    {
            return view('doctor.pages.settings.chamber-form');
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
                
                return view('doctor.pages.settings.chamber-form', ['chamber'=>$chamber])->with('chamberFormType', $chamberFormType);
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
            
//            try{
            
                //save assigned data to the chamber table            
                $chamber->save();
            
//            }catch(\Illuminate\Database\QueryException $ex){
//                
//                return redirect()
//                ->back()
//                ->with($ex)
////                ->with('message','Warning!! Please check that the chamber Id that you have provided is unique, "Chambr ID" and "Chamber Name" fields are reqired.  And all other data(optional) are of desired type. Then try again!')
//                ->with('status', 'danger')
//                ->withInput();
//            }
            
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
                
                $chamber = chamber::where('user_id', $auth_user_id)->where('chamber_id', $chamber_id)->first();
                
                $chamber->delete();
                
                    return redirect()
                    ->route('adminChamber')
                    ->with('message','Chamber Information Removed Seccessfully!')
                    ->with('status', 'success');
    }

}
