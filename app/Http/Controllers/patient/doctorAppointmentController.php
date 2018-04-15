<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Traits\zakiPrivateLibTrait;
use App\Traits\zakiPrivateLibTrait_Patient;


class doctorAppointmentController extends Controller
{
    use zakiPrivateLibTrait;
    use zakiPrivateLibTrait_Patient;
    
  /**
     * This function queries db for data and returns doctor record list to search doctor page.
     * 
     * @return array
     */
    protected function registeredAppointment()
    {   
        $filterItems = [];
        $count = 0;     
        $doctor = [];
        $doctor_item = NULL;
        $doctor_filteredList = [];
 
        
        //DB Query
        $filterItems['district'] = district::select('district')->orderBy('district','asc')->get()->toArray();
        $filterItems['specialty'] = specialty::select('specialty')->groupBy('specialty')->orderBy('specialty','asc')->get()->toArray();
        //***Note Area data not yet complete***
        $personalInfoData = personal_info::select('id','imageUrl')->get()->toArray();           
        $doctorFilterQuery = $this->doctorFilterJointQuery();

        //Make copy of doctorFilterQuery for latter use
        $doctorFilterQuery_2 =  $doctorFilterQuery;                            
                                
        //sort and then splitMultyArray_by_ID();
        usort($doctorFilterQuery, array("App\Http\Controllers\patient\SearchdoctorController", "compareID"));           
        $doctorListGrouped = $this->groupMultyArray_by_ID($doctorFilterQuery);                                                                     
                                
        foreach($doctorListGrouped as $doctorQueryOrganised){
                        
   

            $doctor['id'] = $doctorQueryOrganised[$count]['id'];
            $doctor['thana_district'] = [];
            $doctor['area'] = [];
                    
            
            $doctor_list_Array[] = $doctor;
            $count += $count;
        }

      $tmp ="";   
        return view('patient.doctorAppointment', ['doctors' => $paginated_doctor[$page_number], 'tmp'=>$tmp]);
    }


}
