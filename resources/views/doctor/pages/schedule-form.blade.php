@extends('doctor.pages.schedule')
@section('title', 'Schedule Entry/Edit Form')
@section('description', 'This is the Schedule page')

@section('scheduleHead')

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i> Schedule Entry/Edit Form
        </li>
    </ol>

    @include('notifications.status_message')
    @include('notifications.errors_message')
        
@endsection


@section('scheduleBody')     
        
    <!--Starting the Form-->

    <form action="{{url('doctor/schedule/save')}}" method="post" class="well form-horizontal" id="scheduleForm" role="form">
        <legend>Schedule Information Form</legend>

        <fieldset>

            <!-- Form type holder, hidden-->       

            <input type="hidden" id="formType" name="formType" valeu="<?php if(isset($scheduleFormType)){ //check if schedule data set or blank 
                                                                                echo $scheduleFormType; }
                                                                             elseif(Request::old('formType')){ // or if data exist from privious request
                                                                                echo Request::old('formType');} ?>" /> 

            <!-- Schedule ID Field-->   

            <div class="form-group row">
                <label for="scheduleId" class="col-md-4 control-label">Schedule ID: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                        <input type="text" class="form-control" id="scheduleId" name="scheduleId" readonly value="<?php if(isset($schedule->schedule_id)){ //check if schedule data set or blank 
                                                                                                                                echo ($schedule->schedule_id);}
                                                                                                                            elseif(Request::old('scheduleId')){ // or if data exist from privious request
                                                                                                                                echo Request::old('scheduleId');} ?>" 
                                                                                                                    placeholder="This Will be Auto Generated.."/>

                    </div>
                </div>
            </div>
   
            
            <!--Chamber Name-->

            <div class="form-group row">
                <label for="getChamberId" class="col-md-4 control-label">Chamber Name: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                        <select class="form-control selectpicker" id="getChamberId" name="getChamberId">
                                <option selected="selected">Select Your Chamber.. </option>

                            @foreach($chambers as $chamber)
                                <option value="<?php if(isset($chamber->chamber_id)){  //check if schedule data set or blank
                                                        echo ($chamber->chamber_id);} ?>"> <?php if(isset($chamber->chamber_name)){  //check if schedule data set or blank
                                                                                                            echo ($chamber->chamber_name);} ?> </option>
                            @endforeach 
                        </select>
                    </div>
                </div>
            </div>


  
            <!--Schedule Date-->

            <div class="form-group row">
                <label for="scheduleDate" class="col-md-4 control-label">Schedule Date: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input type="date" class="form-control" name="scheduleDate" id="scheduleDate" required maxlength="10" minlength="8" value="<?php if(isset($schedule->schedule_date)){  //check if schedule data set or blank
                                                                                                                                                            echo ($schedule->schedule_date);} 
                                                                                                                                                        elseif(Request::old('scheduleDate')){ // or if data exist from privious request
                                                                                                                                                            echo Request::old('scheduleDate');} ?>" />
                    </div>
                </div>
            </div>

            <!--Start Time-->

            <div class="form-group row">
                <label for="startTime" class="col-md-4 control-label">Start Time: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                        <input type="time" class="form-control" name="startTime" id="startTime" maxlength="8" value="<?php if(isset($schedule->start_time)){  //check if schedule data set or blank
                                                                                                                                echo ($schedule->start_time);} 
                                                                                                                            elseif(Request::old('startTime')){ // or if data exist from privious request
                                                                                                                                echo Request::old('startTime');} ?>" />
                    </div>
                </div>
            </div>

            <!--End Time-->

            <div class="form-group row">
                <label for="endTime" class="col-md-4 control-label">End Time: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                        <input type="time" class="form-control" name="endTime" id="endTime" maxlength="8" value="<?php if(isset($schedule->end_time)){ //check if schedule data set or blank
                                                                                                                            echo ($schedule->end_time);} 
                                                                                                                        elseif(Request::old('endTime')){ // or if data exist from privious request
                                                                                                                            echo Request::old('endTime');} ?>"  />
                    </div>
                </div>
            </div>

            <br />


            <!--Submit, Delete and Cancel Button-->

            <div class="form-group" id="BTN_saveCancel row">                                
                <div class="col-md-2"></div>
                <div class="col-md-2" style="margin: 3px; padding: 3px;">
                    <?php if(isset($schedule->schedule_id)){ ?>
                            <a href="{{ url('doctor/schedule/remove', ['ScheduleId' => $schedule->schedule_id])}}"><button type="button" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete </button></a>
                    <?php } ?>  
                </div>                
                <div class="col-md-2" style="margin: 3px; padding: 3px;">
                    <button type="submit" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
                </div>
                <div class="col-md-2" style="margin: 3px; padding: 3px;">
                    <a href="/doctor/schedule"><button type="button" class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-stop"></span> Cancel</button></a>
                </div>
                               
            </div>

        </fieldset>
        
        {{ csrf_field() }}
        
    </form>
    
 @endsection
 
 

 @section('jscript')   
 
<!--Custom Java Script to check if the form is loaded as New or Edit form by checking the value of formType hidden field-->    

    <script>    
        var urlNew = window.location.pathname; //Get URL path
            if(urlNew.includes("/edit/")){ //chech value
                document.getElementById('formType').value="edit"; //set value
                document.getElementById('getChamberId').value = '<?php if(isset($schedule->chamber_id)){ echo($schedule->chamber_id);} ?>';
            }else{         
                //This portion gets the submitted form data if it is new data form and modifies the startTime and endTime field data by 
                //adding ':00' (seconds) after existing data and then submits the form.
                var scheduleForm = document.getElementById('scheduleForm');
                
                scheduleForm.onsubmit = function(){
                    var startTimeVar = document.getElementById('startTime');                   
                    var endTimeVar = document.getElementById('endTime');
                    
                    startTimeVar.value = startTimeVar.value + ':00';
                    endTimeVar.value = endTimeVar.value + ':00';
                    
                    document.getElementById('scheduleForm').submit();
                }
            }
    </script>

@endsection