<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Validator;
use App\Traits\zakiPrivateLibTrait;
use App\Traits\zakiPrivateLibTrait_Patient;
use App\Models\district;
use App\Models\personal_info;
use App\Models\specialty;
use App\Models\thana;

class SearchDoctorController extends Controller
{
    use zakiPrivateLibTrait;
    use zakiPrivateLibTrait_Patient;
    
  /**
     * This function queries db for data and returns doctor record list to search doctor page.
     * 
     * @return array
     */
    protected function viewSearchPage(Request $request, $pageNo = NULL)
    {   
        $calenderMonth = '2018-12-01';
        $count = 0;     
        $doctor = [];
        $doctor_item = NULL;
        $doctor_filterList = [];
        $doctorFilterRecord = [];
        $array_data = [];
        $selectedItems = [];
        $page_number = 0;
        $districtsList = district::select('district')->orderBy('district','asc')->get()->toArray();
        $JSONSpecialties = specialty::select('specialty')->get()->toArray();
        $personalInfoData = personal_info::select('id','imageUrl')->get()->toArray();   
        
        $doctorFilterQuery = $this->doctorFilterJointQuery();
        $doctorFilterQuery_2 =  $doctorFilterQuery;                            
                                
        //sort and then splitMultyArray_by_ID();
        usort($doctorFilterQuery, array("App\Http\Controllers\patient\SearchdoctorController", "compareID"));           
        $doctorListGrouped = $this->groupMultyArray_by_ID($doctorFilterQuery);                         
                                
                                
                                
        foreach($doctorListGrouped as $doctorQueryOrganised){
            $uniqueDegreeName = NULL;
            $uniqueSpecialty = NULL;
            $uniqueDistrict = NULL;
            $uniqueThana = NULL;
            $districtList = [];
            $listDegree = [];
            $listSpecialty = [];
                        
            //Loop through and merge personal_info data(imageURL) in to join query records (matching ID)                   
            foreach($personalInfoData as $personalInfoRecord){
                if($personalInfoRecord['id'] == $doctorQueryOrganised[$count]['id']){
                    $doctorFilterRecord['imageUrl'] = $personalInfoRecord['imageUrl'];                  
                }
            }      

            $doctor['id'] = $doctorQueryOrganised[$count]['id'];
            $doctor['first_name'] = $doctorQueryOrganised[$count]['first_name'];
            $doctor['last_name'] = $doctorQueryOrganised[$count]['last_name'];
            $doctor['imageUrl'] = $doctorFilterRecord['imageUrl'];
            $doctor['position'] = $doctorQueryOrganised[$count]['position'];
            $doctor['organization'] = $doctorQueryOrganised[$count]['organization'];
            $doctor['thana_district'] = [];   //$doctorQueryOrganised[$count]['district'];
//            $doctor['thana'] = [];  //$doctorQueryOrganised[$count]['thana']; //needs to be an array
            $doctor['degree_name'] = [];
            $doctor['specialty'] = [];
                    

            //make degree_name list array out from $doctorFilterList  
            foreach($doctorFilterQuery_2 as $doctor_item){
                if($doctor['id'] == $doctor_item['id']){
                    $listDegree[] = $doctor_item['degree_name'];
                }
            }
            $uniqueDegreeName = array_unique(array_column($listDegree, NULL));
            $uniqueDegreeName = array_values($uniqueDegreeName);
            $doctor['degree_name'] = $uniqueDegreeName;
            
            //make specialty list array out from $doctorFilterList
            foreach($doctorFilterQuery_2 as $doctor_item){              ///fix degree array listing
                if($doctor['id'] == $doctor_item['id']){
                    $listSpecialty[] = $doctor_item['specialty'];
                }
            }

            $uniqueSpecialty = array_unique(array_column($listSpecialty, NULL));
            $uniqueSpecialty = array_values($uniqueSpecialty);
            $doctor['specialty'] = $uniqueSpecialty;           
            
            //make district list array out of $doctorFilterList
            $uniqueDistrict = array_unique(array_column($doctorQueryOrganised, "district"));
            $uniqueDistrict = array_values($uniqueDistrict);          
           
            //Make District and Thana combined list
            foreach($uniqueDistrict as $district){
                $count2 = 0;                    
                $thana = [];
                
                //Loop through raw query result
                for($count2; $count2<count($doctorFilterQuery_2); $count2++){
                    if(($doctorFilterQuery_2[$count2]['id'] == $doctor['id']) && ($doctorFilterQuery_2[$count2]['district'] == $district)){
                        $thana[] = $doctorFilterQuery_2[$count2]['thana'];

                    }                        
                }

                //make thana list array out of $doctorFilterQuery_2
                $uniqueThana = array_unique(array_column($thana, NULL));
                $uniqueThana = array_values($uniqueThana);
                $districtList[$district] = $uniqueThana;
            }          
            
            $doctor['thana_district'] = $districtList;
                                            
            //Calender Section. Get calender from zakiPrivateLibTrait.
            $doctor['calender'] = $this->doctorCalender($doctor['id'], $calenderMonth);
            
            $doctor_list_Array[] = $doctor;
            $count += $count;
        }
    
        //Check if Specialty exist
        foreach($doctor_list_Array as $doctor_item_array){           
            
            if(isset($request['specialty']) && $this->multyArray_search($doctor_item_array, 'specialty', $request['specialty'])){
                $doctor_item = $doctor_item_array;
            }else{
                $doctor_item = NULL;
            }
            
            if($doctor_item !== NULL){               
                $doctor_filterList[] = $doctor_item_array;
                $doctor_item = NULL;
            }
        }
        
        if(isset($doctor_filterList[0]['id'])){
            $doctor_list_Array = $doctor_filterList;
            $doctor_filterList = [];
        }
        
        //Check if Thana exist
        foreach($doctor_list_Array as $doctor_item_array){           
            if(isset($request['thana']) && $this->multyArray_search($doctor_item_array, 'thana_district', $request['district'], $request['thana'])){
                $doctor_item = $doctor_item_array;
            }
            
            if($doctor_item !== NULL){               
                $doctor_filterList[] = $doctor_item;
                $doctor_item = NULL;
            }
        }
        
        if(isset($doctor_filterList[0]['id'])){
            $doctor_list_Array = $doctor_filterList;
            $doctor_filterList = [];
        }
    
        //Check if Location exist
        foreach($doctor_list_Array as $doctor_item_array){           
            
            if(isset($request['area']) && $this->multyArray_search($doctor_item, 'area', $request['area'])){
                $doctor_item = $doctor_item_array;
            }else{
                $doctor_item = NULL;
            }
            
            if($doctor_item !== NULL){               
                $doctor_filterList[] = $doctor_item_array;
                $doctor_item = NULL;
            }
        }
        
        if(isset($doctor_filterList[0]['id'])){
            $doctor_list_Array = $doctor_filterList;
            $doctor_filterList = [];
        }
        
        
        //Final Search List Array Re-arranged
        $paginated_doctor = array_chunk($doctor_list_Array, 5);

        
        //Validate Input Page no
        if($pageNo != NULL && is_numeric($pageNo)){
            $page_number = $pageNo - 1;
        }
        
        //Return Extra Array with Pagination Data
        $array_data['total_page'] = count($paginated_doctor);
        $array_data['current_page'] = $page_number;

        
        
        //return dropdown filter item if selected 
        
        if($request['specialty']){
            $selectedItems['specialty'] = $request['specialty'];
        }else{
            $selectedItems['specialty'] = NULL;
        }
        
        if($request['district']){
            $selectedItems['district'] = $request['district'];
        }else{
            $selectedItems['district'] = NULL;
        }
        
//        if($request['thana']){
//            $selectedItems['thana'] = $request['thana'];      //thana return not working (**may be ajax related problem)
//        }else{
//            $selectedItems['thana'] = NULL;
//        }
        
        if($request['area']){
            $selectedItems['area'] = $request['area'];
        }else{
            $selectedItems['area'] = NULL;
        }
        
        
        return view('patient.doctorSearch', ['JSONSpecialties' => $JSONSpecialties, 'districtsList' => $districtsList, 'doctors' => $paginated_doctor[$page_number], 'selectedItems' => $selectedItems, 'array_data' => $array_data, 'temp' => $doctor]);
    }
    
    
      
    
    
   public function equols(){
       if(count($doctor['specialty']) > 0){
                        foreach($doctor['specialty'] as $specialtyRecord){
                            if(array_search($specialtyRecord, array_column($doctorFilterListRecordData, 'specialty'))){
                                
                                $doctor['specialty'][] = $doctorFilterListRecord['specialty'];
                            }
                        }
                    }else{
                        $doctor['specialty'][] = $doctorFilterListRecord['specialty'];
                    }
   }


   
    /**
     * This function takes 'district name' as input via Ajax request, queries db for data and returns 
     * 'thana' list to search doctor page.
     * 
     * @return JSON Array
     */
    public function returnThanaList($districtVal){
        
        if(strlen($districtVal) < 15){
            $thanas = thana::select('thana')->where('district', $districtVal)->orderBy('thana', 'asc')->get()->toArray();
        }else{
            return response()->json('NULL');
        }
        return response()->json($thanas);
    }
 

}
