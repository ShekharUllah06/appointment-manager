@extends('doctor.pages.settings.work-history')
@section('title', 'Work-history Entry/Edit Form')
@section('description', 'This is the Work-History page')

@section('workHistoryHead')

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i> Work History Entry/Edit Form
        </li>
    </ol>

    @include('notifications.status_message')
    @include('notifications.errors_message')
        
@endsection


@section('workHistoryBody')     
        
    <!--Starting the Form-->

    <form action="{{url('admin/settings/work-history/save')}}" method="post" class="well form-horizontal" id="chamberForm" role="form">
        <legend>Work History Information Form</legend>

        <fieldset>

            <!-- Form type holder, hidden-->       

            <input type="hidden" id="formType" name="formType" valeu="<?php if(isset($workHistoryFormType)){ //check if work history data set or blank 
                                                                                echo $workHistoryFormType; }
                                                                             elseif(Request::old('formType')){ // or if data exist from privious request
                                                                                echo Request::old('formType');} ?>" /> 

            <!--Disabled Work History ID Field-->   

            <div class="form-group row">
                <label for="workHistoryId" class="col-md-4 control-label">Work History ID: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" id="workHistoryId" name="workHistoryId" maxlength="4" required value="<?php if(isset($work_history->work_history_id)){ //check if work-history data set or blank 
                                                                                                                                    echo ($work_history->work_history_id);}
                                                                                                                                elseif(Request::old('workHistoryId')){ // or if data exist from privious request
                                                                                                                                    echo Request::old('workHistoryId');} ?>" 
                                                                                                                                accept=""placeholder="Type Work History ID here" required="required" maxlength="4"/>

                    </div>
                </div>
            </div>

            
            <!--Position Name-->

            <div class="form-group row">
                <label for="position" class="col-md-4 control-label">Position Name: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input type="text" class="form-control" name="position" id="position" maxlength="50" required value="<?php if(isset($work_history->position)){  //check if chamber data set or blank
                                                                                                                                                echo ($work_history->position);} 
                                                                                                                                            elseif(Request::old('position')){ // or if data exist from privious request
                                                                                                                                                echo Request::old('position');} ?>" 
                                                                                                                                    placeholder="Type Position Here.." required="required" maxlength="50" minlength="3"/>
                    </div>
                </div>
            </div>

            <!--Organization Name-->

            <div class="form-group row">
                <label for="organization" class="col-md-4 control-label">Organization Name: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                        <input type="text" class="form-control" name="organization" id="organization" maxlength="50" value="<?php if(isset($work_history->organization)){  //check if work-history data set or blank
                                                                                                                                echo ($work_history->organization);}
                                                                                                                            elseif(Request::old('organization')){ // or if data exist from privious request
                                                                                                                                echo Request::old('organization');} ?>" 
                                                                                                                        placeholder="Type Organization Name Here.." maxlength="50"/>
                    </div>
                </div>
            </div>

            <!--Start Date-->

            <div class="form-group row">
                <label for="startDate" class="col-md-4 control-label">Start Date: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input type="date" class="form-control" name="startDate" id="startDate" maxlength="50" required value="<?php if(isset($work_history->start_date)){  //check if work-history data set or blank
                                                                                                                                                echo ($work_history->start_date);} 
                                                                                                                                            elseif(Request::old('startDate')){ // or if data exist from privious request
                                                                                                                                                echo Request::old('startDate');} ?>" 
                                                                                                                                    placeholder="Type Start Date Name Here.." />
                    </div>
                </div>
            </div>

            <!--End Date-->

            <div class="form-group row">
                <label for="endDate" class="col-md-4 control-label">End Date: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                        <input type="date" class="form-control" name="endDate" id="endDate" maxlength="50" value="<?php if(isset($work_history->end_date)){ //check if work-history data set or blank
                                                                                                                        echo ($work_history->end_date);} 
                                                                                                                    elseif(Request::old('endDate')){ // or if data exist from privious request
                                                                                                                        echo Request::old('endDate');} ?>" 
                                                                                                                placeholder="Type Thana(Police Station) Here.." />
                    </div>
                </div>
            </div>

            <!--description-->

            <div class="form-group row">
                <label for="description" class="col-md-4 control-label">Job Description: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                        <textarea class="form-control" id="description" name="description" rows="" maxlength="100" placeholder="Type Your description Here.." maxlength="100"> <?php if(isset($work_history->description)){ //check if work-history data set or blank
                                                                                                                                                                            echo ($work_history->description);} 
                                                                                                                                                                         elseif(Request::old('description')){ // or if data exist from privious request
                                                                                                                                                                            echo Request::old('description');} ?></textarea>
                    </div>
                </div>
            </div>
                    <br />


            <!--Submit, Delete and Cancel Button-->

            <div class="form-group" id="BTN_saveCancel row">
                <div class="col-md-2"></div>
                <div class="col-md-2" style="margin: 3px; padding: 3px;">
                    <?php if(isset($work_history->work_history_id)){ ?>
                            <a href="{{ url('admin/settings/work-history/remove', ['workHistoryId' => $work_history->work_history_id])}}"><button type="button" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete </button></a>
                    <?php } ?>
                </div>
                <div class="col-md-2" style="margin: 3px; padding: 3px;">
                    <button type="submit" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
                </div>
                <div class="col-md-2" style="margin: 3px; padding: 3px;">
                    <a href="/admin/settings/work-history"><button type="button" class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-stop"></span> Cancel</button></a>
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
                document.getElementById('workHistoryId').readOnly = true;
            }
    </script>

@endsection