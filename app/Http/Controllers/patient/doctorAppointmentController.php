<?php
namespace App\Http\Controllers\patient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;
use App\Traits\zakiPrivateLibTrait;
use App\Traits\zakiPrivateLibTrait_Patient;
use App\Models\appointments;
use App\Models\chamber;
use App\Models\education;
use App\Models\personal_info;
use App\Models\schedule;
use App\Models\specialty;
use App\Models\User;
use App\Models\work_history;

class doctorAppointmentController extends Controller
{
    use zakiPrivateLibTrait;
    use zakiPrivateLibTrait_Patient;

  /**
     * This function queries db and shows the Doctor's Chamber Schedule.
     *
     * @return array
     */
    protected function registeredAppointment(Request $request)
    {
        $filterItems = [];
        $count = 0;
        $doctor = [];
        $doctor_item = NULL;
        $doctor_filteredList = [];
        $selectedItems = [];

        // DB Query
        //User Table query
        $dbUser = User::select('id','first_name','last_name')
                      ->where('id', $request->DoctorID)
                      ->get()
                      ->toArray();

        //personal_info Query
        $personalInfoData = personal_info::select('imageUrl')
                                          ->where('id', $request->DoctorID)
                                          ->get()
                                          ->toArray();

        //Assemble the user and personal_info part of infos
        $doctor['id']       = $request->DoctorID;
        $doctor['fullName'] = $dbUser[0]['first_name'] . " " . $dbUser[0]['last_name'];
        $doctor['imageUrl'] = $personalInfoData[0]['imageUrl'];

        //Specialty Query
        $dbSpecialty = specialty::select('specialty')
                                ->orderBy('specialty','asc')
                                ->where('user_id', $request->DoctorID)
                                ->get()
                                ->toArray();
          //change multi level result array to single level array and assign it to $doctor array Item
        foreach ($dbSpecialty as $key => $value) {
          $doctor['specialty'][] = $value['specialty'];
        }

        //Education Query
        $dbEducation = education::select('degree_name')
                                ->orderBy('pass_year','dsc')
                                ->where('user_id', $request->DoctorID)
                                ->get()
                                ->toArray();
          //change multi level result array to single level array and assign it to $doctor array Item
        foreach ($dbEducation as $key => $value){
          $doctor['degree_name'][] = $value['degree_name'];
        }

        //dbChamber query
        $dbChamber =  chamber::select('chamber_name','address','thana','city','post_code','district')
                ->where('chamber_id',$request->chamberID)
                ->where('user_id', $request->DoctorID)
                ->get()
                ->toArray();

        $doctor['chamber_name'] = $dbChamber[0]['chamber_name'];
        $doctor['chamber_address'] = $dbChamber[0]['address'];
        $doctor['chamber_thana'] = $dbChamber[0]['thana'];
        $doctor['chamber_city'] = $dbChamber[0]['city'];
        $doctor['chamber_post_code'] = $dbChamber[0]['post_code'];
        $doctor['chamber_district'] = $dbChamber[0]['district'];

        //Schedule Query
        $dbSchedule = schedule::select('schedule_id','schedule_date')
                          ->where('user_id', $request->DoctorID)
                          ->where('chamber_id', $request->chamberID)
                          ->whereDate('schedule_date', '>=', Carbon::now('Asia/Dhaka')->toDateString()) // get schedules of >= date today
                          ->get()
                          ->toArray();

        $doctor['schedule'] = $dbSchedule;

        return view('patient.doctorAppointment', ['doctor'=>$doctor, 'tmp'=>$dbSchedule]);
    }





 /**
   * @param ajax string scheduleID
   * This function recieves ajax call for schedule date-time with provided scheduleID, queries db and returns the schedule date and times..
   *
   * @return json array
   */
    protected function getAjaxSchedule($scheduleID){
      //Schedule Query
      $dbSchedule = schedule::select('schedule_id','schedule_date','start_time','end_time')
                            ->where('schedule_id', $scheduleID)
                            ->get()
                            ->toArray();

      $dbScheduleFormated =[];

      $dbScheduleFormated['schedule_id'] = $dbSchedule[0]['schedule_id'];
      $dbScheduleFormated['schedule_date'] = date('l', strtotime($dbSchedule[0]['schedule_date']))."  ".date('d-F-Y', strtotime($dbSchedule[0]['schedule_date']));

      $dbScheduleFormated['start_time'] = date('h:i:s a', strtotime($dbSchedule[0]['start_time']));

      $dbScheduleFormated['end_time'] = date('h:i:s a', strtotime($dbSchedule[0]['end_time']));
      $dbScheduleFormated['serialNo'] = appointments::where('schedule_id', $scheduleID)
                                                    ->max('serial_number');

      return response()->json($dbScheduleFormated);
    }



    /**
       * @param HTTP Request scheduleID
       * This function recieves HTTP Request with provided scheduleID, Query appointment
       * table, save appointment and generate, return a serial number redirects to My Appointments page.
       *
       * @return conformation and Serial Number array
       */
    protected function registeredAppointmentSave(Request $request){

      $validator = Validator::make($request->all(),[
          'scheduleID' => 'integer|required|max:99999999999',
          'doctorID' => 'integer|required|max:9999999999',
          'patientID' => 'integer|required|max:9999999999',
      ]);

      //Validate
      if($validator->fails()){
        return redirect()
                ->back()
                ->with('message','Some Informations submited are not of desired format. Please contach site Admin!')
                ->with('status', 'danger')
                ->withInput()
                ->withErrors($validator);
      }

      $appointments = appointments::where('schedule_id', $request['scheduleID'])
                                  ->where('patient_id', $request['patientID'])
                                  ->first();

      // Check if appointment does not allready exist and save
      if($appointments == null || count($appointments) == null || count($appointments) == 0){
          // new appoimntment record instance
          $appointments = new appointments;

          $appointments->schedule_id = $request['scheduleID'];
          $appointments->doctor_id = $request['doctorID'];
          $appointments->patient_id = $request['patientID'];

          //get last(highst) serial_number of this schedule_id
          $serial_number = appointments::where('schedule_id', $request['scheduleID'])
                                      ->max('serial_number');

          // Assign Serial Number
          if($serial_number == 0 || $serial_number == NULL){
            $appointments->serial_number = 1;
          }else{
            $appointments->serial_number = $serial_number + 1;
          }

          // Save appointment or return error
          try{
            $appointments->save();
          }
          catch(Exception $e){
              return redirect()
                      ->back()
                      ->with('message','Failed to save. Please contact the site admin to report the problem.')
                      ->with('status', 'danger')
                      ->withInput()
                      ->withErrors($e);
          }

          // Get actual saved serial number
          $serial_number_new = appointments::where('schedule_id', $request['scheduleID'])
                                            ->where('patient_id', $request['patientID'])
                                            ->max('serial_number');
          // On Successfull Save
          return redirect()
                  ->route('myAppointments')
                  ->with('status', 'success')
                  ->with('message','Appointment made Successfully! Your Serial Number is:  '. $serial_number_new);

        }else{
          // On Failed Cancel
          return redirect()
                  ->route('myAppointments')
                  ->with('message','Appointment to this Doctor on this same Schedule already exist! Please click on "My Appointments" menu on left panel to view your appointments.')
                  ->with('status', 'danger');
        }
    }


    /**
       * @param HTTP GET Request AppointmentID
       * This function recieves HTTP Request with provided AppointmentID, Query appointment
       * table. if appointment exists, soft delet it.
       *
       * @return conformation message
       */
    protected function registeredAppointmentCancel($appointment_id){
        $appointments = appointments::find($appointment_id);
        try {
          $appointments->delete();
        } catch (\Exception $e) {
          // On Failed Save
          return redirect()
                  ->route('myAppointments')
                  ->with('message','Failed to cancel appointment. Please contact the site Admin for assistance.')
                  ->with('status', 'danger');
        }
        // On Successfull Cancel
        return redirect()
                ->route('myAppointments')
                ->with('status', 'success')
                ->with('message','Appointment Canceled Successfully.');

    }



    /**
       * @param HTTP Request scheduleID
       * This function recieves HTTP Request with provided user_id, Query appointment
       * table and return all the scheduled appointments of the user.
       *
       * @return conformation and Serial Number array
       */
    protected function myAppointments($pageNo = NULL){
      $page_number = NULL;
      $myAppointment = [];
      $myAppointmentsArray = [];
      $patient_id = Auth::id();

      //query appointments table
      $appointments = appointments::where('patient_id', $patient_id)
                                  ->get()
                                  ->toArray();

      if(count($appointments) == 0){
        $myAppointmentsArray = null;
        return view('patient.myAppointments', ['myAppointmentsArray'=>$myAppointmentsArray]);
      }
      // Iterate over appointments table query result and assamble a myAppointments array
      foreach($appointments as $appointment){
        //Query users table
          $doctor = User::select('first_name', 'last_name')
                        ->where('id', $appointment['doctor_id'])
                        ->first();

          // Query personal_info table for imageUrl
          $personal_info = personal_info::select('imageUrl')
                                        ->where('id', $appointment['doctor_id'])
                                        ->first();

          // Query work_history table
          $work_history = work_history::select('position', 'organization')
                                      ->where('user_id', $appointment['doctor_id'])
                                      ->first();

          // Query schedule table
          $schedules = schedule::select('schedule_date', 'start_time', 'end_time', 'chamber_id')
                               ->where('schedule_id', $appointment['schedule_id'])
                               ->whereDate('schedule_date', '>=', Carbon::now('Asia/Dhaka')->toDateString()) // get schedules of >= date today
                               ->first();
          // Query Chamber Table
          $chamber = chamber::select('chamber_name', 'consult_fee', 'telephone_number1', 'mobile_number1', 'address', 'thana', 'city', 'district')
                            ->where('chamber_id', $schedules['chamber_id'])
                            ->first();

          // Assamble $myAppointment array
          $myAppointment['appointment_id'] = $appointment['id'];
          $myAppointment['serial_number']  = $appointment['serial_number'];
          $myAppointment['doctor_id']      = $appointment['doctor_id'];
          $myAppointment['first_name']     = $doctor['first_name'];
          $myAppointment['last_name']      = $doctor['last_name'];
          $myAppointment['imageUrl']       = $personal_info['imageUrl'];
          $myAppointment['position']       = $work_history['position'];
          $myAppointment['start_time']     = $schedules['start_time'];
          $myAppointment['end_time']       = $schedules['end_time'];
          $myAppointment['schedule_date']  = $schedules['schedule_date'];
          $myAppointment['chamber_name']   = $chamber['chamber_name'];
          $myAppointment['address']        = $chamber['address'];
          $myAppointment['consult_fee']    = $chamber['consult_fee'];
          $myAppointment['telephone_number1'] = $chamber['telephone_number1'];
          $myAppointment['mobile_number1'] = $chamber['mobile_number1'];
          $myAppointment['thana']          = $chamber['thana'];
          $myAppointment['city']           = $chamber['city'];
          $myAppointment['district']       = $chamber['district'];

          $myAppointmentsArray[] = $myAppointment;
      }

      //sort array records by schedule_date
      usort($myAppointmentsArray, array("App\Http\Controllers\patient\doctorAppointmentController", "compareDateTime"));

      //Final Search List Array Re-arranged
      $myAppointmentsArray = array_chunk($myAppointmentsArray, 5);

      //Validate Input Page no
      if($pageNo != NULL && is_numeric($pageNo)){
          $page_number = $pageNo - 1;
      }else{
        $page_number = 0;
      }

      //Return Extra Array with Pagination Data
      $myAppointmentsArray['total_page'] = count($myAppointmentsArray);
      $myAppointmentsArray['current_page'] = $page_number;

      return view('patient.myAppointments', ['myAppointmentsArray'=>$myAppointmentsArray[$page_number]]);
    }

  }
