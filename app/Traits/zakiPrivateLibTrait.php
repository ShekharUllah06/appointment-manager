<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Traits;

use App\Models\schedule;
use Carbon;
//use Illuminate\Support\Facades\DB;

trait zakiPrivateLibTrait{
    
    protected function doctorCalender($doctorID, $calenderMonth, $profileType = NULL){
        $futureScheduleRecord = [];
        $schedules = [];
        $dateTimeZone = 'Asia/Dhaka';
        $dateToday = Carbon::now($dateTimeZone);
        
        date_default_timezone_set($dateTimeZone);
        
        //Check if requested date is valid and return or return current month date; assembeles as array.
        $returnCalenderMonth = $this->returnCalenderMonth($dateToday, $calenderMonth);
        
        $daysinMonth = cal_days_in_month(CAL_GREGORIAN, $returnCalenderMonth['carbonMonth'], $returnCalenderMonth['carbonYear']) -1;
                              
        //query with schedule table for record with $doctorID         
        $schedulesQuery = $this->scheduleJointQuery($doctorID, $returnCalenderMonth['requestedCalenderMonth'], $daysinMonth);
        
        
                //Get single Record out of DB Result Set
        foreach ($schedulesQuery as $scheduleRecord){     

            //Convert and join schedule date and time
            if($this->multiKeyExists($scheduleRecord, 'schedule_date')){

                $scheduleDate = $scheduleRecord['schedule_date'];
                
            //Compare Schedule date with current date, if schedule date is greater then assamble schedules array
                $futureScheduleRecord = $this->futureSchedule($scheduleRecord, date('Y-m-d', strtotime($scheduleDate)), date('Y-m-d', strtotime($dateToday)), $profileType);
            }
            else{
                
                $futureScheduleRecord = $scheduleRecord;
            }

            //Assemble Schedules Array if $futureScheduleRecord is not null
            if(!$futureScheduleRecord == null){     
                
                $schedules[] = $futureScheduleRecord;
            }               
        }
        
        
        if(empty($schedules)){
            $schedules['monthName'] = jdmonthname(gregoriantojd((int)$returnCalenderMonth['carbonMonth'], 
                        (int)$returnCalenderMonth['carbonDay'] , (int)$returnCalenderMonth['carbonYear']), 1);
            $schedules['scheduleDate'] = $returnCalenderMonth['requestedCalenderMonth'];
            $schedules['scheduleDateOnly'] = $returnCalenderMonth['carbonDay'];
            $schedules['scheduleMonth'] = $returnCalenderMonth['carbonMonth'];
            $schedules['scheduleYear'] = $returnCalenderMonth['carbonYear'];                   
        }

        //make calender array from schedules array
        $calender = $this->makeScheduleCalender($schedules, $returnCalenderMonth['requestedCalenderMonth']);       
        
        return $calender;
    }
    
    
    
    //query on schedule and chamber tables for record with Auth::user()->id
    //param: 1. User ID.
    protected function scheduleJointQuery($auth_user_id, $requestedScheduleDate, $daysinMonth){
        $schedulesQuery = null;

        if($requestedScheduleDate == null){
            $schedulesQuery = schedule::join('users', 'schedule.user_id', '=', 'users.id')       //SQL Join needs to be converted to Laravel Relations!!!
                    ->join('chamber', 'schedule.chamber_id', '=', 'chamber.chamber_id')
                    ->where('schedule.user_id', $auth_user_id)
                    ->get();
        }else{
            $maxMonth = date('Y-m-d', strtotime($requestedScheduleDate.'+'.$daysinMonth.' day')); //Add +total number of days in the month -1 day with $requestedScheduleDate to narrow down results to one month
            $schedulesQuery = schedule::join('users', 'schedule.user_id', '=', 'users.id')       //SQL Join needs to be converted to Laravel Relations!!!
                    ->join('chamber', 'schedule.chamber_id', '=', 'chamber.chamber_id')
                    ->where('schedule.user_id', $auth_user_id)
                    ->whereBetween('schedule_date', [$requestedScheduleDate, $maxMonth])
                    ->get();        

        }    
        
        $schedulesQuery = $schedulesQuery->toArray();
        
        return $schedulesQuery;
    }
    
   
   
        
    /**
     * This is a helper function to check if user requested year-month-date input is of valid data/format type. 
     * If valid, else current date is taken. Date parts are de-assembled in to different variables, date part is 
     * re-set to first day(01) of month and re-assembled. It returns an array consisting the de-assembled variables 
     * along with the re-assembled variable.
     * 
     * @return array
     */   
    private function returnCalenderMonth($dateToday, $calenderMonth = NULL){ 
        
        //set $requestedCalenderMonth validating if paramerter passed. If not passed set current date
        if(isset($calenderMonth)){
            $requestedCalenderMonth_primary  = date('Y-m-d', strtotime($calenderMonth));                           
        }else{
            $requestedCalenderMonth_primary   = date('Y-m-d', strtotime($dateToday));
        }
        
        $requestedCalenderMonth = Carbon::parse($requestedCalenderMonth_primary);
        
        //re-set date to first of the month and re-assemle date
        $carbonDay = '01';
        $carbonMonth = $requestedCalenderMonth->month;
        $carbonYear = $requestedCalenderMonth->year;
        $requestedCalenderMonth = $carbonYear . "-" . $carbonMonth . "-" . $carbonDay;
                
        return array('carbonDay' => $carbonDay, 'carbonMonth' => $carbonMonth, 'carbonYear' => $carbonYear, 'requestedCalenderMonth' => $requestedCalenderMonth);
    } 
    
    
    
    
    //if no record found return to privious page with error message 
    //param: 1. Query Result, 2. Redirect Rout name if fails.
    protected function ifQueryEmpty($schedulesQuery, $route){
        if(count($schedulesQuery)){
            
            return redirect()
                    ->route($route)
                    ->with('message','No Schedule Data found in database. Please Add a new schedule Record!')
                    ->with('status', 'danger'); 
        }
    }
    
    
    //query with schedule table for record with Auth::user()->id
    //param: 1. User ID.
    protected function makeScheduleCalender($schedules, $requestedCalenderMonth){
        $calender = [];
        $tempCalender = [];
        $dateWeekDay = null;
        $j = 1;
        
        if($this->multiKeyExists($schedules, 'scheduleDate') && isset($schedules[0]['scheduleDate'])){
            
            $dateWeekDay = date("w" , strtotime($requestedCalenderMonth));
            $intMonth = (int)$schedules[0]['scheduleMonth'];        
            $calender['monthName'] = jdmonthname(gregoriantojd((int)$schedules[0]['scheduleMonth'], (int)$schedules[0]['scheduleDateOnly'], (int)$schedules[0]['scheduleYear']), 1);
            $calender['year'] = (int)$schedules[0]['scheduleYear'];
            $calender['daysInMonth'] = cal_days_in_month(CAL_GREGORIAN, $intMonth, $calender['year']);
            
        }else{
            
            $dateWeekDay = date("w" , strtotime($requestedCalenderMonth));            
            $intMonth = (int)$schedules['scheduleMonth'];        
            $calender['monthName'] = jdmonthname(gregoriantojd((int)$schedules['scheduleMonth'], (int)$schedules['scheduleDateOnly'], (int)$schedules['scheduleYear']), 1);
            $calender['year'] = (int)$schedules['scheduleYear'];
            $calender['daysInMonth'] = cal_days_in_month(CAL_GREGORIAN, $intMonth, $calender['year']);
        }

        //fill in privious month day fields with empty string to complete table view
        for($i = 0; $i < $dateWeekDay; $i++){
            
            $tempCalender[$i] = "";            
        }

        $i = (int)$dateWeekDay;
        $dateWeekDay_plus_month = (int)$calender['daysInMonth'] + (int)$dateWeekDay;

        //make calender month dates    

        for($i; $i < $dateWeekDay_plus_month; $i++){           

            for($k = 0; $k < count($schedules); $k++){

                if(isset($schedules[$k]['scheduleDateOnly']) && $schedules[$k]['scheduleDateOnly'] == $j){
                    
                    $tempCalender[$i] = $this->makeTempCalender($schedules, $i, $k);
                    
                    break;
                }else{
                    $tempCalender[$i] = $j;  
                }

            }
           $j++;
        }
        
        //Sptit the month in to weeks array
        $splitCalander = array_chunk($tempCalender, 7); 

        foreach($splitCalander as $arrayRow){
            
            $calender['calender'][] = $arrayRow;
        }
        
        $lastRow = count($calender['calender']) - 1;
        $lastDay = count($calender['calender'][$lastRow]);
        
        //fill in blank days of next month days  with empty string to complete table view
            if($lastDay < 6){

                for($i = $lastDay; $i <= 6; $i++){

                    $calender['calender'][$lastRow][$i] = "";
                }
            }
        
                return $calender;
    }
    
    
    
    
    /**
     * This is a helper function to check if $schedules[$k]['startTime'] is provided, assembles 
     * primary data and return array. 
     * 
     * @return array
     */     
    private function makeTempCalender($schedules, $i, $k){  //need t change function name
        $tempCalender = [];
                    if(isset($schedules[$k]['startTime'])){
                        $formadetStarTime = date('h:i:s a', strtotime($schedules[$k]['startTime']));
                        $formadetEndTime = date('h:i:s a', strtotime($schedules[$k]['endTime']));
                        $tempCalender = [                     
                            'date' => $schedules[$k]['scheduleDateOnly'],
                            'chamberName' => $schedules[$k]['chamberName'],
                            'startTime' => $formadetStarTime,
                            'endTime' => $formadetEndTime,
                            'consultFee' => $schedules[$k]['consultFee']
                            ];
                    }else{
                        $tempCalender[$i] = ['date' => $schedules[$k]['consultFee']];

                    }
                return $tempCalender;
    }
    
    
    
    
 
     /**
     * This is a helper function filters out future schedules and creates an array to 
     * return or returns null if no future record found.
     *
     * @return int
     */   
    private function futureSchedule($scheduleRecord, $scheduleDate, $dateToday, $profileType){
                                    
        if($scheduleDate >= $dateToday){

            $scheduleTime           = $scheduleRecord['start_time'];
            $scheduleTimeStamp      = date('Y-m-d H:i:s', strtotime("$scheduleDate $scheduleTime"));
            $carbonConverted_TimeStamp = Carbon::parse($scheduleTimeStamp);

            $date = $carbonConverted_TimeStamp->day;
            $month = $carbonConverted_TimeStamp->month;
            $year = $carbonConverted_TimeStamp->year;

            $futureScheduleRecord['scheduleDate'] = $scheduleDate;
            $futureScheduleRecord['scheduleDateOnly'] = $date;
            $futureScheduleRecord['scheduleMonth'] = $month;
            $futureScheduleRecord['scheduleYear'] = $year;
            $futureScheduleRecord['timeStamp'] = $scheduleTimeStamp;
            
            if($profileType != 'patient'){                          //condition may not apply on appointment!!
                $futureScheduleRecord['chamberName'] = $scheduleRecord['chamber_name'];
                $futureScheduleRecord['startTime'] = $scheduleRecord['start_time'];
                $futureScheduleRecord['endTime'] = $scheduleRecord['end_time'];
                $futureScheduleRecord['consultFee'] = $scheduleRecord['consult_fee'];                           
            }
        }else{
            $futureScheduleRecord = null;
        }
        
        return $futureScheduleRecord;
}
    
        
    /**
     * This is a helper function for usort() at viewScheduleList() function.
     * It outputs +1 or -1 comparing two entries from $schedules['timeStamp'] array.
     *
     * @return int
     */    
    private function compareDateTime($a, $b){                                        
        if($a['timeStamp'] == $b['timeStamp']){
            return 0;
        }
        return ($a["timeStamp"] > $b["timeStamp"]) ? +1 : -1;                 
    }
    
    
    /**
     * This is a helper function works as like array_key_exists() function but intended
     * for multi-dimensional array. It takes an array and a key as parameter.
     *
     * @return boolean
     */  
    private function multiKeyExists(array $array, $key){
        
        if(array_key_exists($key, $array)){
            return true;
        }
        
        foreach($array as $element){
            if(is_array($element)){
                if($this->multiKeyExists($element, $key)){
                    return true;
                }
            }
        }
        
        return false;
    }
          
}

?>