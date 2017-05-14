<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\schedule;
use App\Models\User;
use App\Models\chamber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ScheduleController extends Controller
{

     /**
     * This function queries db for data and returns schedule records to schedule-view page.
     * 
     * @return array
     */
    public function viewScheduleList()
    {
        $auth_user_id = Auth::user()->id;
        
        //query with schedule table for record with Auth::user()->id        
        $schedules = schedule::join('users', 'schedule.user_id', '=', 'users.id')       //SQL Join needs to be converted to Laravel Relations!!!
                ->join('chamber', 'schedule.chamber_id', '=', 'chamber.chamber_id')
                ->where('schedule.user_id', $auth_user_id)
                ->get();//

        //if no record found return to privious page with error message           
        if(empty($schedules[0])){
            
            return redirect()
                    ->route('adminScheduleNew')
                    ->with('message','No Schedule Data found in database. Please Add a new schedule Record!')
                    ->with('status', 'danger'); 
        }
             
        return view('doctor.pages.schedule-view', ['schedules'=>$schedules]);
    }

    
    /**
     * This function just returns schedule-form view
     * 
     * @return view
     */    
    public function newScheduleForm()
    {
        $auth_user_id = Auth::user()->id;
        //query with chamber table for record with Auth::user()->id        
        $chambers = chamber::select('chamber_id','chamber_name')->where('user_id', $auth_user_id)->get(); //
        
        return view('doctor.pages.schedule-form', ['chambers'=>$chambers]);
    }

    
    /**
     * This function just returns schedule-form view with data to edit on taking 
     * Schedule ID from get request from schedule-view Form.
     * 
     * @return array
     */      
    public function editScheduleForm($scheduleId)
    {           $auth_user_id = Auth::user()->id;
                $schedule_id = $scheduleId;
                $scheduleFormType = "edit";
                $schedule = schedule::where('user_id', $auth_user_id)->where('schedule_id', $schedule_id)->first();
                $chambers = chamber::select('chamber_id','chamber_name')->where('user_id', $auth_user_id)->get(); //
                
                return view('doctor.pages.schedule-form', ['schedule'=>$schedule, 'chambers'=>$chambers])->with('scheduleFormType', $scheduleFormType);
    }
    
    
    /**
     * 1. This function takes the post data from schedule-form validates them.
     * 2. Then saves them to db. Or create a new record first if post data is new data 
     *    and then saves them to db. And redirects to schedule-view page.
     * 3. If validation fails, its redirects back to previous Form with data and error message.
     * 
     * @return redirest to schedule-form with error message if any.
     */  

    public function saveSchedule(Request $request){       
        $auth_user_id = Auth::user()->id;
        $schedule = null;
        
        
        //Validating schedulefform input data and show error massege if not valid        
        $validator = Validator::make($request->all(),[
            'getChamberId' => 'string|required|max:4',
            'scheduleDate' => 'date|required|max:10',
            'startTime' => 'date_format:H:i:s|nullable|max:8',
            'endTime' => 'date_format:H:i:s|nullable|max:8',
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
            
          //getting input scheduleId from the form        
            $scheduleId = $request->input('scheduleId');
            $schedule = schedule::where('user_id', $auth_user_id)->where('schedule_id', $scheduleId)->first();
            
        }else{
            
            //create new record            
            $schedule = new schedule; 
            $schedule->user_id = $auth_user_id;
        }      
            
        
            //assign form datas to model fields
            $schedule->chamber_id = $request->input('getChamberId');
            $schedule->schedule_date = $request->input('scheduleDate');
            $schedule->start_time = $request->input('startTime');
            $schedule->end_time = $request->input('endTime');
            
            try{
            
                //save assigned data to the schedule table            
                $schedule->save();
            
            }catch(\Illuminate\Database\QueryException $ex){
                
                return redirect()
                ->back()
                ->with('message','Warning!! Please check that the schedule Id that you have provided is unique, "Chambr Name" and "Schedule Date" fields are reqired.  And all other data(optional) are of desired type. Then try again!')
                ->with('status', 'danger')
                ->withInput();
            }
            
            return redirect()
                    ->route('adminSchedule')
                    ->with('message','Schedule Information Saved!')
                    ->with('status', 'success');
    }
    
    
    /**
     * This function deletes schedule record from database table schedule with primary key passed from schedule-form. 
     * 
     * 
     * @return redirect
     */    
    public function removeSchedule($cId)
    {           $auth_user_id = Auth::user()->id;
                $schedule_id = $cId;
                
                $schedule = schedule::where('user_id', $auth_user_id)->where('schedule_id', $schedule_id)->first();
                
                $schedule->delete();
                
                    return redirect()
                    ->route('adminSchedule')
                    ->with('message','Schedule Information Removed Seccessfully!')
                    ->with('status', 'success');
    }
    
}
