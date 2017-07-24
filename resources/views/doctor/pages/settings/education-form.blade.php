@extends('doctor.pages.settings.education')
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
        
    <!--Starting the Form--->

    <form action="{{url('doctor/settings/education/save')}}" method="post" class="well form-horizontal" id="educationForm" role="form">
        <legend>Education Information Form</legend>

        <fieldset>

             <!--Form type holder, hidden-->       

            <input type="hidden" id="formType" name="formType" value="<?php if(isset($educationFormType)){ //check if education data set or blank 
                                                                                echo $educationFormType; }
                                                                             elseif(Request::old('formType')){ // or if data exist from privious request
                                                                                echo Request::old('formType');} ?>" /> 
            
            <!--Degree Name-->

            <div class="form-group row">
                <label for="degreeName" class="col-md-4 control-label">Degree Name: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-certificate"></i></span>
                        <input type="text" class="form-control" name="degreeName" id="degreeName" required maxlength="50" value="<?php if(isset($education->degree_name)){  //check if education data set or blank
                                                                                                                                                echo ($education->degree_name);} 
                                                                                                                                            elseif(Request::old('degreeName')){ // or if data exist from privious request
                                                                                                                                                echo Request::old('degreeName');} ?>" 
                                                                                                                                    placeholder="Type Education Name Here.." />
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
                                                                                                                            elseif(Request::old('instituteName')){ // or if data exist from privious request
                                                                                                                                echo Request::old('instituteName');} ?>" 
                                                                                                                        placeholder="Type Institute Name Here.." />
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
                                                                                                                                            elseif(Request::old('passYear')){ // or if data exist from privious request
                                                                                                                                                echo Request::old('passYear');} ?>" 
                                                                                                                                    placeholder="Type Year of Passing Here.." />
                    </div>
                </div>
            </div>
            
                <br />


            <!--Submit, Delete and Cancel Button-->

            <div class="form-group" id="BTN_saveCancel row">
                <div class="col-md-2"></div>
                <div class="col-md-2" style="margin: 3px; padding: 3px;">                
                    <?php if(isset($education->institute_name)){ ?>
                        <a href="{{ url('doctor/settings/education/remove', ['degreeName' => $education->degree_name])}}"><button type="button" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete </button></a>
                    <?php } ?>
                </div>
                <div class="col-md-2" style="margin: 3px; padding: 3px;">
                    <button type="submit" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
                </div>
                <div class="col-md-2" style="margin: 3px; padding: 3px;">
                    <a href="/doctor/settings/education"><button type="button" class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-stop"></span> Cancel</button></a>
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
                document.getElementById('degreeName').readOnly = true;
            }
    </script>

@endsection