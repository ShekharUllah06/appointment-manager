@extends('layouts.patient')
@section('title', 'Registered Appointment')
@section('description', 'This is the Appointment form for Registered Users')


@section('content')

@include('notifications.status_message')
@include('notifications.errors_message')
<!--Info section start-->
<?php $i = 0; ?>
<div style="text-align: center; margin: 10px;">
  <div class="row">
      <!--Profile Image-->
      <div class="col-md-3">
          <img height="180px" style="height: 170px; width: 170px; border-radius: 20%;" src="{{ url('public/assets/img/'.$doctor['imageUrl']) }}" alt="Profile Picture" />
      </div>
      <!--Short Description-->
      <div class="col-md-8 shortDescription">
          <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
              <h4>
                  <b>
                      {{ ucfirst($doctor['fullName']) }}
                  </b>
              </h4>
          </div>
          <div class="row"  style="margin-bottom: 5px;">
              <span>
                  <?php if(isset($doctor['position'])){
                                print("<b>Position: </b>".$doctor['position']);
                          }else{
                                print("<b>Position: </b>"."Unknown Job Position");
                          }
                  ?>
              </span>
          </div>
          <div class="row" style="margine-top: 5px; margin-bottom: 5px;">
              <span>
                  <?php if(isset($doctor['organization'])){
                                print("<b>Organization: </b>");
                                print($doctor['organization']);
                          }else{
                                print("<b>Organization: </b>");
                                print("Unknown Organization");
                          }
                  ?>
              </span>
          </div>
          <div class="row" style="margine-top: 5px; margin-bottom: 5px;">
              @if(count($doctor['degree_name']) < 1)
                  <!--Education Information not yet submitted.-->
              @else
                  <span>
                      <b>Degree:</b> {{ $doctor['degree_name'][0] }}
                  </span>
                  @if(count($doctor['degree_name']) > 1)
                      <div class="collapse" id="deg{{ $i }}">
                          <?php $j = 1;
                                for($j; $j<count($doctor['degree_name']); $j++){
                          ?>
                              <span style="margin-left: 3px;">
                                  {{ $doctor['degree_name'][$j] }}<br />
                              </span>
                          <?php } ?>
                      </div>
                      <button id="seeDeg{{ $i }}" onclick="changeBtnTxt()" data-toggle="collapse" data-target="#deg{{ $i }}" aria-expanded="false" aria-controls="{{ $i }}" style="border:none; background-color: white; color: gray;">
                          See more &#9661;
                      </button>
                  @endif
              @endif
          </div>
          <div class="row" style="margin-top: 5px; margin-bottom: 5px;">
              @if(count($doctor['specialty']) < 1)
                  Specialties Information not yet submitted.
              @else
                  <span>
                      <b>Specialties: </b> {{ $doctor['specialty'][0] }}
                  </span>
                  @if(count($doctor['specialty']) > 1)
                      <div class="collapse" id="sec{{ $i }}">
                          <?php $k = 0;
                                for($k; $k<count($doctor['specialty']); $k++){
                          ?>
                              <span style="margin-left: 3px;">
                                  {{ $doctor['specialty'][$k] }}<br />
                              </span>
                          <?php } ?>
                      </div>
                      <button id="seeSpc{{ $i }}" onclick="changeBtnTxt()" data-toggle="collapse" data-target="#sec{{ $i }}" aria-expanded="false" aria-controls="{{ $i }}" style="border:none; background-color: white; color: gray;">
                          See more &#9661;
                      </button>
                  @endif
              @endif
          </div>
      </div>
  </div>

  <hr />

  <div class="row">
    <!--Starting the Form-->
    <form action="{{url('patient/appointment/save')}}" method="POST" role="form">
      <fieldset>
        <div class="row form-group">
          <div  class="col-md-3">
            <label for="scheduleDate">Available Schedule Dates:</label>
          </div>
          <div class="col-md-4">
            <input type="hidden" id="doctorID" name="doctorID" value="{{ $doctor['id'] }}" />
            <input type="hidden" id="patientID" name="patientID" value="{{ Auth::user()->id }}" />
            <input type="hidden" id="scheduleID" name="scheduleID" value="" />

            <select id="scheduleDate" name="scheduleDate" class="col-md-3 form-control">
              @foreach($doctor['schedule'] as $schedule)
                <option value="{{$schedule['schedule_id']}}">
                  {{ date('l', strtotime($schedule['schedule_date']))." ".date('d-m-Y', strtotime($schedule['schedule_date'])) }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <p style="font-size:small; color: blue;">* You have to select a schedule from dropdown menu left/above before clicking Submit Button.
            </p>
          </div>
        </div>

        <div class="row form-group" style="margin-top: 10px;">
          <div  class="col-md-3">
            <label for="date">Date:</label>
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control" id="date" name="" value="" disabled />
          </div>
        </div>
        <div class="row" style="margin-top: 10px;">
          <div class="col-md-3">
            <label for="timeFrom">Time Starting from:</label>
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control" id="timeFrom" name="" value="" disabled />
          </div>
        </div>
        <div class="row" style="margin-top: 10px;">
          <div class="col-md-3">
            <label for="timeTo">To:</label>
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control" id="timeTo" name="" value="" disabled />
          </div>
        </div>
        <div class="row" style="margin-top: 10px;">
          <div class="col-md-3">
            <label for="timeTo">Chamber Details:</label>
          </div>
          <div class="col-md-4">
            <textarea type="text" class="form-control" id="chamberName" name="" rows="4" disabled>{{ ucfirst($doctor['chamber_name']) }}, {{ ucfirst($doctor['chamber_address']) }}, {{ ucfirst($doctor['chamber_thana']) }}, {{ ucfirst($doctor['chamber_city']) }}, {{ ucfirst($doctor['chamber_post_code']) }}, {{ ucfirst($doctor['chamber_district']) }}
            </textarea>
          </div>
        </div>
        <div class="row" style="margin-top: 25px; margin-bottom: 25px;">
            <div class="col-md-3" style="color: blue; margine-left: 15px;">
              <label for="scheduleId"><h4>Your Aproximated Serial Number:</h4></label>
            </div>
            <div class="col-md-2">
              <b><input type="text" class="form-control input-lg" id="serialNo" name="" value=""  style="text-align: center; color: black; font-size: bigger; background-color: lightblue;" disabled /></b>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
              <p style="font-size: small">
                <span style="color:red;">**</span> This is an aproximated Serial Number. May not be your Actual Serian Number, considering how many other appointments are been made befor you submit.
              </p>
            </div>
        </div>
        <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp Confirm Appointment</button>
          </div>
        </div>
      </fieldset>
      {{ csrf_field() }}
    </form>
  </div>
    <?php $i++; ?>
</div>



@endsection

@section('jscriptPatient')
<script>
  // function getAjaxSchedule(scheduleID){
        $(document).ready(function(scheduleID){
          $("#scheduleDate").click(function(){
            let myUrl = "/patient/appointment/getAjaxSchedule/";
            scheduleID = $("#scheduleDate").val();

            $.ajax({
              url: myUrl + scheduleID,
              type: "GET",
              contentType: "application/json",
              dataType: "json",
              success: function(data){
                $("#date").val(data['schedule_date']);
                $("#timeFrom").val(data['start_time']);
                $("#timeTo").val(data['end_time']);
                $("#scheduleID").val(data['schedule_id']);
                if(data['serialNo']){
                  $("#serialNo").val(data['serialNo']+1); // query and get last serial number.
                }else{
                  $("#serialNo").val('1'); // query and get last serial number.
                }
              },
              error: function(data){
                console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
              }
            });

          });
        });



          // let scheduleID = document.getElementById('scheduleDateCombo').value;
          // alert(document.getElementById('scheduleDateCombo').value);
        // }

        function changeBtnTxt(){

            var target= event.target || event.srcElement;
            var id = target.id;
            var txtElem = document.getElementById(id);
            var text = txtElem.textContent || txtElem.innerText;

            if (text.includes("See more")) {

                txtElem.textContent = "See less \u25B3"

            }else{

                txtElem.textContent = "See more \u25BD"

            }
        }

</script>

@endsection
