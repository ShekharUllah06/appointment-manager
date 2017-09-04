<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Traits\zakiPrivateLibTrait;
use Carbon;
use Schedule;

class PagesController extends Controller
{
    use zakiPrivateLibTrait;
    
    public function getHome()
    {

        return view('front.pages.home');

    }
    
    
    public function getDoctorPublicProfile($doctorID, $calenderMonth = null){       
                //declear variables
        $calender = [];
        $schedules = [];
        $futureScheduleRecord = [];
        $dateTimeZone = 'Asia/Dhaka';
        $dateToday = Carbon::now($dateTimeZone);
        
        date_default_timezone_set($dateTimeZone);
        
        //Check if requested date is valid and return or return current month date; assembeles as array.        
        $returnCalenderMonth = $this->returnCalenderMonth($calenderMonth, $dateToday);

        $daysinMonth = cal_days_in_month(CAL_GREGORIAN, $returnCalenderMonth['carbonMonth'], $returnCalenderMonth['carbonYear']) -1;
        
        //query with schedule table for record with Auth::user()->id         
        $schedulesQuery = $this->scheduleJointQuery($doctorID, $returnCalenderMonth['requestedCalenderMonth'], $daysinMonth);

        //Get single Record out of DB Result Set
        foreach ($schedulesQuery as $scheduleRecord){     

            //Convert and join schedule date and time
            if($this->multiKeyExists($scheduleRecord, 'schedule_date')){

                $scheduleDate = $scheduleRecord['schedule_date'];
                
            //Compare Schedule date with current date, if schedule date is greater then assamble schedules array
                $futureScheduleRecord = $this->futureSchedule($scheduleRecord, $scheduleDate, $dateToday);
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

        return view('front.pages.doctor_public_profile', ['calender' => $calender]);

    }
}
