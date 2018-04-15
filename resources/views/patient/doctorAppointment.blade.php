@extends('patient.search')
@section('title', 'Registered Appointment')
@section('description', 'This is the Appointment form for Registered Users')


@section('registeredApointment')     
    <div>
        <!--Info section start-->
        <div class="col-md-7">
            <div class="row">
                <!--Profile Image-->
                <div class="col-md-3">
                    <img src="{{ url('storage/uploads/avatars/'.$doctor['imageUrl']) }}" class="cardImage" alt="Profile Picture">
                    
                    <a href="{{ url('/doctor_profile', ['DoctorID' => $doctor['id'], 'CalanderMonth' => \Carbon\Carbon::now()->format('Y-m-d')]) }}"><button class="btn btn-default" style="margin-top: 10px;">View Profile</button></a>
                </div>
                <!--Short Description-->
                <div class="col-md-7 shortDescription">
                    <div class="row">
                        <h4>
                            <b>
                                <?php if($doctor['first_name']){ echo(ucfirst($doctor['first_name']));} ?>
                                <?php if($doctor['last_name']){echo(ucwords($doctor['last_name'])); } ?>
                            </b>
                        </h4>
                    </div>
                    <div class="row">                           
                        <span style="border: 5px; padding: 5px;">
                            <?php if(isset($doctor['position'])){
                                            print($doctor['position']);
                                            print(", <b>At: </b>");
                                            print($doctor['organization']);                                     
                                    }else{ 
                                            print("Unknown");
                                            print(", <b>At: </b>");
                                            print("Unknown");  
                                    }
                            ?>
                        </span>
                    </div>
                    <div class="row">
                        @if(count($doctor['degree_name']) < 1)
                            <!--Education Information not yet submitted.-->
                        @else
                            <span style="border: 5px; padding: 5px;">
                                <b>Degree:</b> {{ $doctor['degree_name'][0] }}
                            </span>  
                            @if(count($doctor['degree_name']) > 1)
                                <div class="collapse" id="deg{{ $i }}" style="margin-right: 10px;">
                                    <?php $j = 1;
                                          for($j; $j<count($doctor['degree_name']); $j++){
                                    ?>
                                        <span style="border: 5px; padding: 5px;">
                                            {{ $doctor['degree_name'][$j] }}<br />
                                        </span>
                                    <?php } ?>
                                </div>
                                <button id="seeDeg{{ $i }}" onclick="changeBtnTxt()" data-toggle="collapse" data-target="#deg{{ $i }}" aria-expanded="false" aria-controls="{{ $i }}" style="border:none; background-color: white; color: gray; margin-top: 5px; margin-bottom: 5px;">
                                    See more &#9661;
                                </button>
                            @endif
                        @endif                                
                    </div>
                    <div class="row">
                        @if(count($doctor['specialty']) < 1)
                            Specialties Information not yet submitted.
                        @else
                            <span style="border: 5px; padding: 5px;">
                                <b>Specialties: </b> {{ $doctor['specialty'][0] }}
                            </span>
                            @if(count($doctor['specialty']) > 1)
                                <div class="collapse" id="sec{{ $i }}" style="margin-right: 10px;">
                                    <?php $k = 0;
                                          for($k; $k<count($doctor['specialty']); $k++){
                                    ?>
                                        <span style="border: 5px; padding: 5px;">
                                            {{ $doctor['specialty'][$k] }}<br />
                                        </span>
                                    <?php } ?>
                                </div>
                                <button id="seeSpc{{ $i }}" onclick="changeBtnTxt()" data-toggle="collapse" data-target="#sec{{ $i }}" aria-expanded="false" aria-controls="{{ $i }}" style="border:none; background-color: white; color: gray; margin-top: 5px; margin-bottom: 5px;">
                                    See more &#9661;
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div>
        <select>
            <option>sss</option> 
        </select>
        <div>
            Date: Saterday - 10/09/2018 <br>
            Time from:  05:30
                to: 09:30 <br>
            Chamber Name: Janaji Medicle<br>
            <h3>Estimated Current Serial Number:</h3><h2>31</h2> 
        </div>
        <button>Confirm Appointment</button>
    </div>

    <hr />  
    <?php print'<pre>'; print_r($tmp); print"</pri>"; ?>
    
@endsection

@section('jscriptPatientSearch')    
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
        
//        add district and thana data with page link
        function passFilter(pageUrl){
            this.event.preventDefault();
            var specialtyName = document.getElementById('specialty').value;
            var districtName = document.getElementById('district').value;
            var thanaName = document.getElementById('thana').value;
            var areaName = document.getElementById('area').value;
            
            if(!specialtyName){
                specialtyName = null;
            }

            
            var pageUrlComplete = pageUrl + "/" + specialtyName + "/" + districtName + "/" + thanaName + "/" + areaName;
            window.location = pageUrlComplete;
            

        }
        
         
    </script>
@endsection