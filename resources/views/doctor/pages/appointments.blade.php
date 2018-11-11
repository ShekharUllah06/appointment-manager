@extends('layouts.doctor')
@section('title', 'Appointments List View')
@section('description', 'This is the Appointments returnThanaList page for Doctors')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
      <li class="active">
          <i class="fa fa-dashboard"> Appointments List View</i>
      </li>
  </ol>
      @include('notifications.status_message')
      @include('notifications.errors_message')

  <div class="form-group row" style="text-align: center; font-size: 18px;">
      <div class="col-md-1"></div>
      <label for="selectSchedule" class="col-md-2 control-label">
        Schedules: </label>
      <div class="col-md-7 selectContainer">
        <div class="inputGroup">
          <form action="{{url('doctor/appointments')}}" method="GET">
            <select id="selectSchedule" class="form-control" name="select">
              @foreach($schedule_ids as $schedule_id)
                @if($schedule_id["schedule_id"] == $schedule_data['schedule_id'])
                  <option value='{{$schedule_id["schedule_id"]}}_{{$schedule_id["chamber_id"]}}' selected>
                @else
                  <option value='{{$schedule_id["schedule_id"]}}_{{$schedule_id["chamber_id"]}}'>
                @endif
                    {{ date('l', strtotime($schedule_id["schedule_date"]))." ".date('d-M-Y', strtotime($schedule_id["schedule_date"]))." @ ".$schedule_id["chamber_name"] }}
                  </option>
              @endforeach
            </select>
          </form>
        </div>
      </div>
  </div>
  <div class="well" style="font-size: 16px;">
     <div class="row">
       <label for='chamberName' class="col-md-2">Chamber: </label>
       <div id='chamberName' class="col-md-8" > {{ $schedule_data['chamber']['chamber_name'] }} </div>
     </div>
     <div class="row">
       <label for='scheduleDate' class="col-md-1">Date: </label>
       <div id='scheduleDate' class="col-md-3" >
         {{ date('l', strtotime($schedule_data['schedule']["schedule_date"]))." ".date('d-M-Y', strtotime($schedule_data['schedule']["schedule_date"])) }}
       </div>


       <label for='scheduleTime' class="col-md-2">Start time: </label>
       <div id='startTime' class="col-md-2" >
         {{ date('h:m:s a', strtotime($schedule_data['schedule']["start_time"])) }}
       </div>
       <label for='scheduleTime' class="col-md-2">End time: </label>
       <div id='endTime' class="col-md-2" >
         {{ date('h:m:s a', strtotime($schedule_data['schedule']["end_time"])) }}
       </div>
     </div>
   </div>
   <!-- <div class="row"> -->
     <table class="table table-striped" style="margin-top: 15px;">
       <thead>
         <tr>
           <th>Serial Number</th>
           <th>Patient Name</th>
           <th>Patient Age</th>
           <th>Gender/Sex</th>
           <th>Appointment Status</th>
           <th>Accept</th>
           <th style="text-align:right">Reject</th>
         </tr>
       </thead>
       @forelse($appointments as $appointment)
         <tr>
           <td> {{ $appointment->serial_number }} </td>
           <td> {{ $userData[$appointment->id]['first_name'] }} {{ $userData[$appointment->id]['last_name'] }} </td>
           <td>
             <?php
             //generate age from dob
                print \Carbon\Carbon::parse($userData[$appointment->id]['date_of_birth'])->diff(\Carbon\Carbon::now())->format('%y years, %m months');
             ?>
           </td>
           <td>
             @if($userData[$appointment->id]['gender'] == "0")
                <?php print("Male"); ?>
             @elseif($userData[$appointment->id]['gender'] == "1")
                <?php print("Female"); ?>
             @elseif($userData[$appointment->id]['gender'] == "2")
                <?php print("Transgender"); ?>
             @else
                <?php print("Undifined"); ?>
             @endif

           </td>
             @if($appointment->status == NULL)
                <td>
                <?php print("pending"); ?>
             @else
                @if($appointment->status == "confirm")
                  <td style="color:green">
                @else
                  <td style="color:red">
                @endif
                {{ $appointment->status }}ed
             @endif
           </td>
           <td>
             @if($appointment->status !== "confirm")
               <a href="appointments/ajaxConfirm/confirm/{{ $appointment->id }}/{{$appointment->patient_id}}" name = "confirm" id ='{{ $appointment->id }}'>
                   <button class="btn btn-md btn-success">
                       <span class="glyphicon glyphicon-ok"></span>
                   </button>
               </a>
             @endif
           </td>
           <td style="text-align:right">
             @if($appointment->status !== "cancel")
               <a href="appointments/ajaxConfirm/cancel/{{ $appointment->id }}/{{ $appointment->patient_id }}" name = "cancel" id ='{{ $appointment->id }}'>
                   <button class="btn btn-md btn-danger">
                       <span class="glyphicon glyphicon-remove"></span>
                   </button>
               </a>
             @endif
           </td>
         </tr>
       @empty
       <tr>
         <td colspan="6" style="text-align:center; color: brown;">No Appointments Found!</td>
       </tr>
       @endforelse
     </table>
   <!-- </div> -->
 </div>
 <div style="text-align:center">
   {{ $appointments->links() }}
 </div>


<?php print'<pre>'; print_r($tmp); print"</pre>"; ?>
@endsection


@section('jscript')

  <script>
    $(document).ready(function(){
      $("#selectSchedule").change(function(){
          $("form").submit();
      });

      $('a').click(function(){
        let appointmentID = $(this).attr('id');
        let action = $(this).attr('name');

        // $.ajax({
        //     url: "/doctor/appointments/ajaxConfirm/" + action + "/" + appointmentID,
        //     type: "GET",
        //     contentType: "application/json",
        //     dataType: "json",
        //     success: function(data){
        //       alert(data);
        //       // $("#date").val(data['schedule_date']);
        //     },
        //     error: function(data){
        //       // alert('di');
        //       console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
        //     }
        //   });
      });
    });
  </script>
@endsection
