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
    protected function viewSearchPage(Request $request, $pageNo = NULL, $forwardspecialty = NULL, $forwardDistrict = NULL, $forwardThana = NULL, $forwardArea = NULL)
    {   
        $filterItems = [];
        $calenderMonth = date("Y-m-d");
        $count = 0;     
        $doctor = [];
        $doctor_item = NULL;
        $doctor_filteredList = [];
        $doctorFilterRecord = [];
        $array_info = [];
        $selectedItems = [];
        $page_number = 0;
        
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
            $uniqueDegreeName = NULL;
            $uniqueSpecialty = NULL;
            $uniqueDistrict = NULL;
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
            $doctor['thana_district'] = [];
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
           
            $districtList = $this->combianDistrictThana($uniqueDistrict, $doctorFilterQuery_2, $doctor);
            
            $doctor['thana_district'] = $districtList;
                                            
            //Calender Section. Get calender from zakiPrivateLibTrait.
            $doctor['calender'] = $this->doctorCalender($doctor['id'], $calenderMonth);
            
            $doctor_list_Array[] = $doctor;
            $count += $count;
        }
        $tmp = $doctor_list_Array;
        //Check if Specialty exist
        foreach($doctor_list_Array as $doctor_item_array){           
            
            if(isset($request['specialty']) && $this->multyArray_search($doctor_item_array, 'specialty', $request['specialty'])){
                $doctor_item = $doctor_item_array;
            }elseif(isset($forwardspecialty) && $this->multyArray_search($doctor_item_array, 'specialty', $forwardspecialty)){
                $doctor_item = $doctor_item_array;
            }else{
                $doctor_item = NULL;
            }
            
            if($doctor_item !== NULL){               
                $doctor_filteredList[] = $doctor_item_array;
                $doctor_item = NULL;
            }
        }
        
        if(isset($doctor_filteredList[0]['id'])){
            $doctor_list_Array = $doctor_filteredList;
            $doctor_filteredList = [];
        }
        
        //Check if Thana exist
        foreach($doctor_list_Array as $doctor_item_array){           
            if(isset($request['thana']) && $this->multyArray_search($doctor_item_array, 'thana_district', $request['district'], $request['thana'])){
                $doctor_item = $doctor_item_array;
            }elseif(isset($forwardThana) && $this->multyArray_search($doctor_item_array, 'thana_district', $forwardDistrict, $forwardThana)){
                $doctor_item = $doctor_item_array;
            }else{
                $doctor_item = NULL;
            }
            
            if($doctor_item !== NULL){               
                $doctor_filteredList[] = $doctor_item;
                $doctor_item = NULL;
            }
        }
        
        if(isset($doctor_filteredList[0]['id'])){
            $doctor_list_Array = $doctor_filteredList;
            $doctor_filteredList = [];
        }
    
        //Check if Area exist
        foreach($doctor_list_Array as $doctor_item_array){           
            
            if(isset($request['area']) && $this->multyArray_search($doctor_item, 'area', $request['area'])){
                $doctor_item = $doctor_item_array;
            }elseif(isset($forwardArea) && $this->multyArray_search($doctor_item, 'area', $forwardArea)){
                $doctor_item = $doctor_item_array;
            }else{
                $doctor_item = NULL;
            }
            
            if($doctor_item !== NULL){               
                $doctor_filteredList[] = $doctor_item_array;
                $doctor_item = NULL;
            }
        }
        
        if(isset($doctor_filteredList[0]['id'])){
            $doctor_list_Array = $doctor_filteredList;
            $doctor_filteredList = [];
        }
        
        
        //Final Search List Array Re-arranged
        $paginated_doctor = array_chunk($doctor_list_Array, 5);

        
        //Validate Input Page no
        if($pageNo != NULL && is_numeric($pageNo)){
            $page_number = $pageNo - 1;
        }
        
        //Return Extra Array with Pagination Data
        $array_info['total_page'] = count($paginated_doctor);
        $array_info['current_page'] = $page_number;

        
        
        //return dropdown filter item if selected 
        //return selected specialty
        if($request['specialty']){
            $selectedItems['specialty'] = $request['specialty'];
        }elseif(isset($forwardspecialty) && $forwardspecialty != "null" && $forwardspecialty != ""){
            $selectedItems['specialty'] = $forwardspecialty;
        }else{
            $selectedItems['specialty'] = "";
        }
        //return selected district
        if($request['district']){
            $selectedItems['district'] = $request['district'];
        }elseif(isset($forwardDistrict) && $forwardDistrict != "null" && $forwardDistrict != ""){
            $selectedItems['district'] = $forwardDistrict;
        }else{
            $selectedItems['district'] = "";
        }
        //return selected thana
        if($request['thana']){
            $selectedItems['thana'] = $request['thana'];        //For improvement Need to return full thana list by district with selected thana data insteade of just one thana
        }elseif(isset($forwardThana) && $forwardThana != "null" && $forwardThana != ""){
            $selectedItems['thana'] = $forwardThana;
        }else{
            $selectedItems['thana'] = "";
        }
        //return selected area
        if($request['area']){
            $selectedItems['area'] = $request['area'];
        }elseif(isset($forwardArea) && $forwardArea != "null" && $forwardArea != ""){
            $selectedItems['area'] = $forwardArea;
        }else{
            $selectedItems['area'] = "";
        }
        
        
        return view('patient.doctorSearch', ['filterItems' => $filterItems, 'doctors' => $paginated_doctor[$page_number], 'selectedItems' => $selectedItems, 'array_info' => $array_info, 'tmp'=>$tmp]);
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
