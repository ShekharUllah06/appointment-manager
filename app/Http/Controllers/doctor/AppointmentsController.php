<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\personal_info;
use App\Models\schedule;
use App\Models\appointments;
use App\Models\chamber;
use App\Notifications\notifyAppointment;
use Carbon\Carbon;



class AppointmentsController extends Controller
{

//This function queries user appoint table and returns all appointments informations related to the doctor.
    public function viewAppointments(Request $request)
    {
        $schedule_data = [];
        $userData = [];
        $schedule_ids = [];
        $scheduleID = NULL;
        $chamberID = NULL;
        $userID = Auth::user()->id;

        //separate the schedule and chamber ids from $schedule_chamberID
        if($request['select']){
          $ids = explode("_", $request['select']);
          $scheduleID = $ids[0];
          $chamberID = $ids[1];
        }

    //schedule select option section
        $schedule_id_queries = schedule::select('schedule_id','chamber_id','schedule_date','start_time','end_time')
                                ->where('user_id', $userID)
                                ->whereDate('schedule_date', '>=', Carbon::now(+6)->toDateString())
                                ->orderBy('schedule_date', 'ASC')
                                ->orderBy('start_time', 'ASC')
                                ->get();

        foreach($schedule_id_queries as $schedule_id_query){
          $chamber_query = $this->chamberQuery($userID,  $schedule_id_query['chamber_id']);
          $schedule_id['schedule_id'] = $schedule_id_query['schedule_id'];
          $schedule_id['schedule_date'] = $schedule_id_query['schedule_date'];
          $schedule_id['chamber_id'] = $chamber_query['chamber_id'];
          $schedule_id['chamber_name'] = $chamber_query['chamber_name'];

          $schedule_ids[] = $schedule_id;
        }

    //chamber information section
        if($scheduleID == NULL){
          $schedule_data['schedule'] = $schedule_id_queries[0];
          $scheduleID =  $schedule_id_queries[0]['schedule_id'];
        }else{
          $schedule_data['schedule'] = schedule::select('schedule_id','chamber_id','schedule_date','start_time','end_time')
                                  ->where('user_id', $userID)
                                  ->where('schedule_id', $scheduleID)
                                  ->orderBy('schedule_date', 'ASC')
                                  ->orderBy('start_time', 'ASC')
                                  ->first();
        }

        if($chamberID == NULL){
          $chember_id = schedule::select('chamber_id')
                                  ->where('user_id', $userID)
                                  ->where('schedule_id', $schedule_ids[0]['schedule_id'])
                                  ->first();
          $chamberID = $chember_id['chamber_id'];
        }

        $schedule_data['chamber'] = $this->chamberQuery($userID, $chamberID);
        $schedule_data['schedule_id'] = $scheduleID;
    //appointments section
        $appointments = $this->appointmentsQuery($userID, $scheduleID);

        foreach($appointments as $appointment){
          $userQuery = User::select('first_name','last_name')
                            ->where('id', $appointment['patient_id'])
                            ->first();

          $personal_InfoQuery = personal_info::select('date_of_birth', 'gender')
                            ->find($appointment['patient_id']);

          $userData[$appointment['id']]['first_name'] = $userQuery['first_name'];

          $userData[$appointment['id']]['last_name'] = $userQuery['last_name'];

          $userData[$appointment['id']]['date_of_birth'] = $personal_InfoQuery['date_of_birth'];

          $userData[$appointment['id']]['gender'] = $personal_InfoQuery['gender'];
        }

       return view('doctor.pages.appointments', ['appointments' => $appointments, 'schedule_ids' => $schedule_ids, 'schedule_data' => $schedule_data, 'userData' => $userData, 'tmp' => ""]);
    }



//This function queries chamber table
    private function chamberQuery($userID, $chamberID){
          $chamber =  chamber::select('chamber_name','chamber_id')
                              ->where('chamber_id', $chamberID)
                              ->where('user_id', $userID)
                              ->first();

      return $chamber;
    }


//This function queries appointments table
    private function appointmentsQuery($userID, $scheduleID){
        $appointments = appointments::where('schedule_id', $scheduleID)
                                    ->where('doctor_id', $userID)
                                    ->orderBy('schedule_id', 'ASC')
                                    ->paginate(30);
      return $appointments;
    }


  //This function Confirms or cancels (save to db) the appointments atatus and sends notifications to the patients

      public function confirmAppointments($action, $appointmentID, $userID){

          $user = User::find($userID);
          $patientName = $user->first_name." ".$user->last_name;
          $dortorName = Auth::user()->first_name." ".Auth::user()->last_name;
          $appointments = appointments::find($appointmentID);

          $appointments->status = $action;

          $msg = "Dear ".$patientName.", Your appointment to Dr. ".$dortorName." was ".$action."ed.";

          $arr = [
            'data' => $msg
          ];
          // $when = Carbon::now()->addSeconds(10);
          $user->notify(new notifyAppointment($arr));

          $appointments->save();

        return redirect()
              ->route('doctorAppointments')
              ->with('message','Saved!')
              ->with('status', 'success');
      }



  //This function Rejects the appointments

      public function rejectAppointments($appointmentID){

        return response()->json($appointmentID);
      }
}
