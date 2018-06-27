@extends('layouts.patient')
@section('title', 'MyAppointments')
@section('description', 'This is the MyAppointment page for Registered Users')


@section('content')

<div class="container-fluid">
<!-- Page Heading --->
    <div class="row">
        <div class="col-lg-12">
          <ol class="breadcrumb">
              <li class="active">
                  <i class="fa fa-dashboard"></i> My Appointments
              </li>
          </ol>
              @include('notifications.status_message')
              @include('notifications.errors_message')
      </div>
    </div>
<!-- /.row -->
    <!--Result Section-->
  <?php
    if(!is_null($myAppointmentsArray) && count($myAppointmentsArray)){
      $i = 0;
      foreach ($myAppointmentsArray as $myAppointment){
  ?>
    <div class="row resultCard" style="margin-top: 5px; margin-bottom: 5px; padding-top: 5px; padding-bottom: 5px; border-bottom: 1px solid gray;">

        <!--Info section start-->
        <div class="col-md-11" style="margin-bottom: 5px; padding-bottom: 5px;">
                <!--Profile Image-->
                <div class="col-md-2">
                  <div>
                    <img src="{{ url('public/assets/img/'.$myAppointment['imageUrl']) }}" class="cardImage" alt="Profile Picture">
                  </div>
                  <div style="padding-top: 5px">
                    <a href="{{url('/doctor_profile', ['DoctorID' => $myAppointment['doctor_id']])}}"><button class="btn btn-primary">View Profile</button></a>
                  </div>
                </div>
            <!--Short Description-->
            <div class="row">
                      <div class="col-md-9 shortDescription">
                            <div class="row">
                              <b class='col-md-3'>Schedule date: </b>
                                <p class='col-md-3' style='text-alignment: left;'>{{ date('d-M-Y', strtotime($myAppointment['schedule_date'])) }}</p>
                            </div>
                            <div class="row">
                                 <b class='col-md-3'>Start time: </b>
                                    <p class='col-md-3' style='text-alignment: left;'>{{ date('h:m:i a', strtotime($myAppointment['start_time'])) }}</p>
                                 <b class='col-md-3'>End time: </b>
                                    <p class='col-md-3' style='text-alignment: left;'>{{ date('h:m:i a', strtotime($myAppointment['end_time'])) }}</p>
                            </div>
                            <div class="row">
                                <b class='col-md-3'>Serial number: </b>
                                    <b class='col-md-3' style='text-alignment: left; color: brown; font-size: large;'>{{ $myAppointment['serial_number'] }}</b>
                            </div>
                            <div class="row"><b class='col-md-3'>Dr. </b><p style='text-alignment: left;'>
                                {{ ucfirst($myAppointment['first_name']) }}
                                {{ ucfirst($myAppointment['last_name']) }}
                              </p>
                            </div>

                          <!-- colupsable "see more" section-->
                          <div class="collapse" id="deg{{ $i }}" style="margin-right: 10px;">
                              <div class="row">
                                <b class='col-md-3'>Position: </b>
                                  <p style='text-alignment: left;'>
                                    {{ ucfirst($myAppointment['position']) }}
                                  </p>
                              </div>
                              <div class="row">
                                <b class='col-md-3'>Cunsultation fee: </b>
                                  <p class='col-md-3' style='text-alignment: left;'>{{ $myAppointment['consult_fee'] }}</p>
                              </div>
                              <div class="row">
                                <b class='col-md-3'>Chamber name: </b>
                                  <p class='col-md-3' style='text-alignment: left;'>{{ ucfirst($myAppointment['chamber_name']) }}</p>
                                <b class='col-md-3'>Chamber adress: </b>
                                  <p class='col-md-3' style='text-alignment: left;'>{{ ucfirst($myAppointment['address']) }}</p>
                              </div>
                              <div class="row">
                                <b class='col-md-3'>Phone number: </b>
                                  <p class='col-md-3' style='text-alignment: left;'>{{ $myAppointment['telephone_number1'] }}</p>
                                <b class='col-md-3'>Mobile number: </b>
                                  <p class='col-md-3' style='text-alignment: left;'>{{ $myAppointment['mobile_number1'] }}</p>
                              </div>
                              <div class="row">
                                  <b class='col-md-3'>Thana: </b>
                                    <p class='col-md-3' style='text-alignment: left;'>{{ ucfirst($myAppointment['thana']) }}</p>
                                  <b class='col-md-3'>City: </b>
                                    <p class='col-md-3' style='text-alignment: left;'>{{ ucfirst($myAppointment['city']) }}</p>
                              </div>
                              <div class="row">
                                  <b class='col-md-3'>District: </b>
                                    <p class='col-md-3' style='text-alignment: left;'>{{ ucfirst($myAppointment['district']) }}</p>
                                    <b class='col-md-3'>Country: </b>
                                      <p class='col-md-3' style='text-alignment: left;'>Not Available</p>
                              </div>
                          </div>
                          <button id="seeDeg{{ $i }}" onclick="changeBtnTxt()" data-toggle="collapse" data-target="#deg{{ $i }}" aria-expanded="false" aria-controls="{{ $i }}" style="border:none; background-color: white; color: gray; margin-top: 5px; margin-bottom: 5px;">
                              See more &#9661;
                          </button>
                        </div>
                    </div>
                </div>

        <!--right flot remove cancel button-->
        <div class="col-md-1" style="float: right; padding-top: 5px;">
              <a href="{{url('/patient/appointment/cancel', ['AppointmentID' => $myAppointment['appointment_id']])}}"><button class="btn btn-danger" style="margin-top: 10px;"><span class="glyphicon glyphicon-remove"></span></button></a>
        </div>
      </div>
    <?php
    //end foreach
        $i++;
           }
      }else{
        print("<h3>No Appointment Data fount!</h3> If you are trying to book an appointment, then click on 'Find Doctor' menu item on left panel and click 'Get Appointment' button situated on right side of each Doctor record shown.");
      }
   ?>
 </div>

<!--Pagination Navigation Section-->
  <div class="row">
    <?php
        if((isset($myAppointment['total_page'])) && ($myAppointment['total_page'] > 1)){
            $count = 0;
            print('<div class="col-md-3"></div>'
                    . '<div class="col-md-6 text-center">'
                    . '<nav aria-label="Page navigation">'
                    . '<ul class="pagination">');


            //Original return page number starts at 0, but we are displaying and submitting pagination links starting from 1.
            //Previous Button
            if($array_info['current_page'] > 0){
                ?>
                    <li class="page-item">
                        <a href=" {{url('patient/myappointments', ['pageNo' => $myAppointment['current_page']])}} " class="page-link" onclick="passFilter($(this).attr('href'))"  aria-label="Previous">
                            <span aria-hidden="true"> &laquo; </span>
                            <span class="sr-only"> Previous </span>
                        </a>
                    </li>
                <?php

            }

            //Page Numbers
            for($count; $count < $myAppointment['total_page']; $count++){
                $count2 = $count + 1;
                ?>
                    <li class="page-item">
                        <a href="{{ url('patient/myappointments', ['pageNo' => $count2]) }}" class="page-link" onclick="passFilter($(this).attr('href'))">{{ $count2 }}</a>
                    </li>
                <?php
            }

            //Next Button
            if(($myAppointment['total_page'])-($myAppointment['current_page']) > 1){
                ?>
                    <li>
                        <a href="{{ url('patient/myappointments', ['pageNo' => $myAppointment['current_page'] +2]) }}" class="page-link" onclick="passFilter($(this).attr('href'))" aria-label="Next">
                            <span aria-hidden="true"> &raquo; </span>
                            <span class="sr-only"> Next </span>
                        </a>
                    </li>
                <?php
            }

            print('</ul>'
                    . '</nav>'
                    . '</div>'
                    . '<div class="col-md-3"></div>');
        }
      ?>
  </div>
@endsection

@section('jscriptPatient')
<script>
//        Change See More Buten Text
        function changeBtnTxt(){

            var target= event.target || event.srcElement;
            var id = target.id;
            var txtElem = document.getElementById(id);
            var text = txtElem.textContent || txtElem.innerText;

            if (text.includes("See more")) {

                txtElem.innerHTML = "See less <html>&#9651;</html>";

            }else{

                txtElem.innerHTML = "See more <html>&#9661;</html>";

            }
        }
</script>

@endsection
