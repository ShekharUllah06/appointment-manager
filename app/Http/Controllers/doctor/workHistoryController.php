<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\work_history;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class workHistoryController extends Controller
{
       
    /**
     * This function queries db for data and returns work-history records to chamber-view page.
     * 
     * @return array
     */
    public function viewWorkHistory()
    {        
        $auth_user_id = Auth::user()->id;
        
        //query with work-history table for record with Auth::user()        
        $work_histories = work_history::where('user_id', $auth_user_id)->get(); //

        //if no record found redirect to "work_history/new" page with error message           
        if(empty($work_histories[0])){
            
            return redirect()
                    ->route('doctorWorkHistoryNew')
                    ->with('message','No Work History Data found in database. Please Add a new Work History Record!')
                    ->with('status', 'danger'); 
        }
             
        return view('doctor.pages.settings.work-history-view', ['work_histories'=>$work_histories]);

    }
    
    
    /**
     * This function just returns work-history-form view
     * 
     * @return view
     */    
    public function newWorkHistoryForm()
    {
            return view('doctor.pages.settings.work-history-form');
    }

    
    /**
     * This function just returns work-history-form view with data to edit on taking 
     * work-history ID from get request from work-history-view Form.
     * 
     * @return array
     */      
    public function editWorkHistoryForm($workHistoryId)
    {           $auth_user_id = Auth::user()->id;
                $work_history_id = $workHistoryId;
                $work_history_form_type = "edit";
                $work_history = work_history::where('user_id', $auth_user_id)->where('work_history_id', $work_history_id)->first();
                
                return view('doctor.pages.settings.work-history-form', ['work_history'=>$work_history])->with('work_history_form_type', $work_history_form_type);
    }
    
    
    /**
     * 1. This function takes the post data from work-history-form validates them.
     * 2. Then saves them to db. Or create a new record first if post data is new data 
     *    and then saves them to db. And redirects to work-history-view page.
     * 3. If validation fails, its redirects back to previous Form with data and error message.
     * 
     * @return redirest to work-history-form with error message if any.
     */  
    public function saveWorkHistory(Request $request){            
        $auth_user_id = Auth::user()->id;
        $work_history = null;
        
        //Validating work-history form input data and show error massege if not valid        
        $validator = Validator::make($request->all(),[
            'workHistoryId' => 'string|required|max:4',
            'position' => 'string|nullable|max:50',
            'organization' => 'string|nullable|max:50',
            'startDate' => 'date|required|max:10',
            'endDate' => 'date|nullable|max:50',
            'currentPosition' => 'string|nullable|max:3',
            'description' => 'string|nullable|max:100',

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
            
          //getting input workHistoryId from the form        
            $workHistoryId = $request->input('workHistoryId');
            $work_history = work_history::where('user_id', $auth_user_id)->where('work_history_id', $workHistoryId)->first();
            
        }else{
            
            //create new record            
            $work_history = new work_history;
 
            $work_history->user_id = $auth_user_id;
            $work_history->work_history_id = $request->input('workHistoryId');

        }      
            
        
            //assign form datas to model fields
            $work_history->position = $request->input('position');
            $work_history->organization = $request->input('organization');
            $work_history->start_date = $request->input('startDate');
            $work_history->description = $request->input('description');
            
            if($request->input('currentPosition')){
                $work_history->current_position = $request->input('currentPosition');
                $work_history->end_date = null;
            }else{
                $work_history->end_date = $request->input('endDate');
                $work_history->current_position = null;
            }
            
            try{
            
                //save assigned data to the personal_info table            
                $work_history->save();
            
            }catch(\Illuminate\Database\QueryException $ex){
                
                return redirect()
                ->back()
//                ->with('message','Warning!! Please check that the work_history_id that you have provided is unique, "Work History Id" field is reqired.  And all other data(optional) are of desired type. Then try again!')
                ->with('status', 'danger')
                        ->with('message', $ex->getMessage())
                ->withInput();
            }
            
            return redirect()
                    ->route('doctorWorkHistory')
                    ->with('message','Work History Information Saved!')
                    ->with('status', 'success');
    }
    
    
    /**
     * This function deletes work-history record from database table work history with primary key passed from work-history-form. 
     * 
     * 
     * @return redirect
     */    
    public function removeWorkHistory($workHistoryId)
    {           $auth_user_id = Auth::user()->id;
                $work_history_id = $workHistoryId;
                
                $work_history = work_history::where('user_id', $auth_user_id)->where('work_history_id', $work_history_id)->first();
                
                $work_history->delete();
                
                    return redirect()
                    ->route('doctorWorkHistory')
                    ->with('message','Work History Information Removed Seccessfully!')
                    ->with('status', 'success');
    }

}
