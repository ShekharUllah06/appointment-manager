<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Traits;

use App\Models\education;
use App\Models\User;
use App\Models\schedule;


trait zakiPrivateLibTrait_Patient{

    //query on schedule and chamber tables for record with Auth::user()->id
    //param: 1. User ID.
    protected function doctorFilterJointQuery(){
        $doctorFilterQuery = education::select('users.id','users.first_name','users.last_name','work_history.position','work_history.organization','education.degree_name','specialty.specialty','chamber.chamber_id','chamber.chamber_name','chamber.district','chamber.thana')
                                ->leftjoin('users', function($join){
                                   $join->on('education.user_id', '=', 'users.id')
                                        ->where('users.userType','1');
                                })                                                                                       //SQL Join needs to be converted to Laravel Relations!!!
                                ->leftjoin('work_history', function($join){
                                    $join->on('users.id', '=', 'work_history.user_id')
                                          ->where('work_history.current_position', 'on');
                                })
                                ->leftjoin('chamber', 'users.id', '=', 'chamber.user_id')
                                ->leftjoin('specialty', 'users.id', '=', 'specialty.user_id')
                                ->get()
                                ->toArray();

        // $doctorFilterQuery = schedule::find(2);

        return $doctorFilterQuery;
    }


    /**
     * Helper function. It takes Query and return a District and Thana combined array
     *
     * @param type $uniqueDistrict
     * @param type $doctorFilterQuery_2
     * @param type $doctor
     */
    protected function combianDistrictThana($uniqueDistrict, $doctorFilterQuery_2, $doctor){
        $districtList = [];
        $uniqueThana = NULL;
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
            $uniqueThana = array_unique($thana);
            $uniqueThana = array_values($uniqueThana);
            $districtList[$district] = $uniqueThana;

            return $districtList;
        }
    }




    /**
     * Helper function. Take array as input and Sort then return result array.
     *
     * @param type $array
     * @return type $array
     */
    protected function groupMultyArray_by_ID($array){
        $returnMultiArray = [];
        $temp = 0;
        $tempArray = [];
        $uniqueValue = array_unique(array_column($array, "id"));
        $key = 0;
        foreach($uniqueValue as $k=>$v){
            $temp = next($uniqueValue);
            $key = key($uniqueValue);

            $tempArray = array_slice($array, $k, $key);
            $returnMultiArray[] = $tempArray;
        }

        return $returnMultiArray;
    }



    /** A Helper Function for SeacrhDoctor Controller that checks if data
     * exists in Multi-Dimentional Array and returns TRUE, else FALSE. Parameter
     * &data_2 is optional. In case of thana_district field search parameter
     * $data == district name and $data_2 == thana name.
     *
     * @return boolean
     */
    public function multyArray_search($array, $field, $data, $data_2 = NULL){

        if($field == 'specialty'){
            foreach($array['specialty'] as $specialtyRecord){

                if($specialtyRecord == $data){
                return $specialtyRecord;
                    return TRUE;
                }
            }
        }elseif($field == 'thana_district'){
            foreach($array[$field] as $a=>$b){
                if($a == $data){
                    foreach ($array[$field][$a] as $thana){
                        if($thana == $data_2){
                            return TRUE;
                        }
                    }
                }
            }
        }else{
            if($array[$field] == $data){

                    return TRUE;
            }
        }

        return FALSE;
    }



    /**
     * This is a helper function for usort() at viewScheduleList() function.
     * It outputs +1 or -1 comparing two entries from $schedules['timeStamp'] array.
     *
     * @return int
     */
    private function compareID($a, $b){
        if($a['id'] == $b['id']){
            return 1;
        }
        return ($a['id'] > $b['id']) ? +1 : -1;
    }


}
