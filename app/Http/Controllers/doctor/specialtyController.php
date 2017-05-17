<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class specialtyController extends Controller
{
    /**
    *This function queries specialty table with user_id taken from Auth::user().
    *and returns the specialty with the query data.
    *
     *  @return type array
    */
    public function viewSpecialty()                        
    {
        $auth_user_id = Auth::user()->id;
        
        //query with specilty table for record with Auth::user()->id        
        $specialties = specialty::where('user_id', $auth_user_id)->get(); //change first() if posible      
        
        //return view to specilty page with specilty query object.        
        return view('doctor.pages.settings.specialty', ['specialties'=>$specialties]);
    }
     
    
    /**
    *This function updates the input data from specilty page form too database table specilty.
    *It validates the data before updating,
    *
     *  @return type array
    */
    
    public function saveSpecialty(Request $request)
    {
        $auth_user_id = Auth::user()->id;
        $specialty = null;
        
        //Validating specilty form input data and show error massege if not valid       
        $validator = Validator::make($request->all(),[
            'specialty' => 'string|required|max:10',
            ]);
        
        if($validator->fails()){   
            
            return redirect()
                ->back()
                ->with('message','Please input the Informations Correctly!')
                ->with('status', 'danger')
                ->withInput()
                ->withErrors($validator);
        }
        
            //getting input specialty data from the form        
            $specialtyName = $request->input('specialty');
            
            
            //query with specialty table for record with input specialty        
            $specialties = specialty::where('user_id', $auth_user_id)->where('specialty', $specialtyName)->first();
            
            if(isset($specialties->specialty)){
               return redirect()
                ->back()
                ->with('message','Specialty Name Already Exist! Please Enter A New Specialty Name.')
                ->with('status', 'danger')
                ->withInput()
                ->withErrors($validator);
            }
            //assign form datas to model fields
            $specialties = new specialty;
            $specialties->user_id = $auth_user_id;
            $specialties->specialty = $request->input('specialty');

            
            try{  
                //save assigned data to the personal_info table            
                $specialties->save();
            }catch(\Illuminate\Database\QueryException $ex){
                
                return redirect()
                    ->back()
                    ->with('message','Please Contact Admin!')
                    ->with('status', 'danger')
                    ->withInput();
            }            
            //return view to Specialties page with personal_info query object.            
            return redirect()
                    ->route('doctorSpecialty', ['specialties'=>$specialties])
                    ->with('message','Personal Information Saved!')
                    ->with('status', 'success');
    }
    
    
    /**
     * This function deletes specialty record from database table specialty with primary key passed from specialty-form. 
     * 
     * 
     * @return redirect
     */    
    public function removeSpecialty($specialtyName)
    {           $auth_user_id = Auth::user()->id;
                $specialty_name = $specialtyName;
                
                $specialty = specialty::where('user_id', $auth_user_id)->where('specialty', $specialty_name)->first();
                
                $specialty->delete();
                
                    return redirect()
                    ->route('doctorSpecialty')
                    ->with('message','Specialty Information Removed Seccessfully!')
                    ->with('status', 'success');
    }
    
}

