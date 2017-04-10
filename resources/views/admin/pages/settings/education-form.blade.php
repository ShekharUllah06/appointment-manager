@extends('admin.pages.settings.education')
@section('title', 'Education Entry/Edit Form')
@section('description', 'This is the Education page')

@section('educationHead')

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i> Education Entry/Edit Form
        </li>
    </ol>

    @include('notifications.status_message')
    @include('notifications.errors_message')
        
@endsection


@section('educationBody')     
        
    <!--Starting the Form-->

    <form action="{{url('admin/settings/education/save')}}" method="post" class="well form-horizontal" id="educationForm" role="form">
        <legend>Education Information Form</legend>

        <fieldset>

             <!--Form type holder, hidden-->       

            <input type="hidden" id="formType" name="formType" valeu="<?php if(isset($educationFormType)){ //check if education data set or blank 
                                                                                echo $educationFormType; }
                                                                             elseif(Request::old('formType')){ // or if data exist from privious request
                                                                                echo Request::old('formType');} ?>" /> 

            <!--Disabled Education ID Field-->   

            <div class="form-group row">
                <label for="educationId" class="col-md-4 control-label">Education Record ID: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" id="educationId" name="educationId" maxlength="4" required value="<?php if(isset($education->education_id)){ //check if education data set or blank 
                                                                                                                                    echo ($education->education_id);}
                                                                                                                                elseif(Request::old('educationId')){ // or if data exist from privious request
                                                                                                                                    echo Request::old('educationId');} ?>" 
                                                                                                                                accept=""placeholder="Type Education ID here" required="required" maxlength="4"/>

                    </div>
                </div>
            </div>


            <!--Institute Name-->

            <div class="form-group row">
                <label for="instituteName" class="col-md-4 control-label">Institute Name: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                        <input type="text" class="form-control" name="instituteName" id="instituteName" maxlength="50" value="<?php if(isset($education->institute_name)){  //check if education data set or blank
                                                                                                                                echo ($education->institute_name);}
                                                                                                                            elseif(Request::old('institute_name')){ // or if data exist from privious request
                                                                                                                                echo Request::old('institute_name');} ?>" 
                                                                                                                        placeholder="Type Institute Name Here.." maxlength="50"/>
                    </div>
                </div>
            </div>

            <!--Education Name-->

            <div class="form-group row">
                <label for="degreeName" class="col-md-4 control-label">Degree Name: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-certificate"></i></span>
                        <input type="text" class="form-control" name="degreeName" id="degreeName" maxlength="50" value="<?php if(isset($education->degree_name)){  //check if education data set or blank
                                                                                                                                                echo ($education->degree_name);} 
                                                                                                                                            elseif(Request::old('degree_name')){ // or if data exist from privious request
                                                                                                                                                echo Request::old('degree_name');} ?>" 
                                                                                                                                    placeholder="Type Education Name Here.." required="required" maxlength="50" minlength="3"/>
                    </div>
                </div>
            </div>

            <!--Pass Year-->

            <div class="form-group row">
                <label for="passYear" class="col-md-4 control-label">Year of Pass: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input type="number" class="form-control" name="passYear" id="passYear" maxlength="4" value="<?php if(isset($education->pass_year)){  //check if education data set or blank
                                                                                                                                                echo ($education->pass_year);} 
                                                                                                                                            elseif(Request::old('pass_year')){ // or if data exist from privious request
                                                                                                                                                echo Request::old('pass_year');} ?>" 
                                                                                                                                    placeholder="Type Year of Passing Here.." required="required" maxlength="50" minlength="3"/>
                    </div>
                </div>
            </div>
            
                <br />


            <!--Submit and Cancel Button-->

            <div class="form-group" id="BTN_saveCancel row">
                <div class="col-md-4 control-label"></div>
                <div class="col-md-2" style="margin: 3px; padding: 3px;">
                    <button type="submit" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
                </div>
                <div class="col-md-2" style="margin: 3px; padding: 3px;">
                    <a href="/admin/settings/education"><button type="button" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-stop"></span> Cancel</button></a>
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
            }
    </script>

@endsection