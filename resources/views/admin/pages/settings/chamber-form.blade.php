@extends('admin.pages.settings.chamber')
@section('title', 'Chamber Entry/Edit Form')
@section('description', 'This is the Chamber page')

@section('chamberHead')

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i> Chamber Entry/Edit Form
        </li>
    </ol>

    @include('notifications.status_message')
    @include('notifications.errors_message')
        
@endsection


@section('chamberBody')     
        
    <!--Starting the Form-->

    <form action="{{url('admin/settings/chamber/save')}}" method="post" class="well form-horizontal" id="chamberForm" role="form">
        <legend>Chamber Information Form</legend>

        <fieldset>

            <!-- Form type holder, hidden-->       

            <input type="hidden" id="formType" name="formType" valeu="<?php if(isset($chamberFormType)){ //check if chamber data set or blank 
                                                                                echo $chamberFormType; }
                                                                             elseif(Request::old('formType')){ // or if data exist from privious request
                                                                                echo Request::old('formType');} ?>" /> 

            <!--Disabled Chamber ID Field-->   

            <div class="form-group row">
                <label for="chamberId" class="col-md-4 control-label">Chamber ID: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" id="chamberId" name="chamberId" maxlength="4" required value="<?php if(isset($chamber->chamber_id)){ //check if chamber data set or blank 
                                                                                                                                    echo ($chamber->chamber_id);}
                                                                                                                                elseif(Request::old('chamberId')){ // or if data exist from privious request
                                                                                                                                    echo Request::old('chamberId');} ?>" 
                                                                                                                                accept=""placeholder="Type Chamber ID here" required="required" maxlength="4"/>

                    </div>
                </div>
            </div>


            <!--Institute Name-->

            <div class="form-group row">
                <label for="institute" class="col-md-4 control-label">Institute Name: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                        <input type="text" class="form-control" name="institute" id="institute" maxlength="50" value="<?php if(isset($chamber->institute)){  //check if chamber data set or blank
                                                                                                                                echo ($chamber->institute);}
                                                                                                                            elseif(Request::old('institute')){ // or if data exist from privious request
                                                                                                                                echo Request::old('institute');} ?>" 
                                                                                                                        placeholder="Type Institute Name Here.." maxlength="50"/>
                    </div>
                </div>
            </div>

            <!--Chamber Name-->

            <div class="form-group row">
                <label for="chamber_name" class="col-md-4 control-label">Chamber Name: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input type="text" class="form-control" name="chamber_name" id="chamber_name" maxlength="50" required value="<?php if(isset($chamber->chamber_name)){  //check if chamber data set or blank
                                                                                                                                                echo ($chamber->chamber_name);} 
                                                                                                                                            elseif(Request::old('chamber_name')){ // or if data exist from privious request
                                                                                                                                                echo Request::old('chamber_name');} ?>" 
                                                                                                                                    placeholder="Type Chamber Name Here.." required="required" maxlength="50" minlength="3"/>
                    </div>
                </div>
            </div>

            <!--Telephone Number-1-->

            <div class="form-group row">
                <label for="telephone_number1" class="col-md-4 control-label">Telephone Number-1: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                        <input type="number" class="form-control" name="telephone_number1" id="telephone_number1" maxlength="12" value="<?php if(isset($chamber->telephone_number1)){  //check if chamber data set or blank
                                                                                                                                                echo ($chamber->telephone_number1);} 
                                                                                                                                            elseif(Request::old('telephone_number1')){ // or if data exist from privious request
                                                                                                                                                echo Request::old('telephone_number1');} ?>" 
                                                                                                                                            placeholder="Type 1'st Telephone Number Here.." />
                    </div>
                </div>
            </div>

            <!--Telephone Number-2-->

            <div class="form-group row">
                <label for="telephone_number2" class="col-md-4 control-label">Telephone Number-2: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                        <input type="number" class="form-control" name="telephone_number2" id="telephone_number2" maxlength="12" value="<?php if(isset($chamber->telephone_number2)){ //check if chamber data set or blank
                                                                                                                                                echo ($chamber->telephone_number2);} 
                                                                                                                                            elseif(Request::old('telephone_number2')){ // or if data exist from privious request
                                                                                                                                                echo Request::old('telephone_number2');} ?>" 
                                                                                                                                            placeholder="Type 2'nd Telephone Number Here.."  />
                    </div>
                </div>
            </div>

            <!--Telephone Number-3-->

            <div class="form-group row">
                <label for="telephone_number3" class="col-md-4 control-label">Telephone Number-3: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                        <input type="number" class="form-control" name="telephone_number3" id="telephone_number3" maxlength="12" value="<?php if(isset($chamber->telephone_number3)){ //check if chamber data set or blank
                                                                                                                                                echo ($chamber->telephone_number3);} 
                                                                                                                                            elseif(Request::old('telephone_number3')){ // or if data exist from privious request
                                                                                                                                                echo Request::old('telephone_number3');} ?>" 
                                                                                                                                            placeholder="Type 3'rd Telephone Number Here.."  />
                    </div>
                </div>
            </div>

            <!--Mobile Number-1-->

            <div class="form-group row">
                <label for="mobile_number1" class="col-md-4 control-label">Mobile/Cell Phone Number-1: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                        <input type="number" class="form-control" name="mobile_number1" id="mobile_number1" maxlength="12" value="<?php if(isset($chamber->mobile_number1)){ //check if chamber data set or blank
                                                                                                                                            echo ($chamber->mobile_number1);} 
                                                                                                                                        elseif(Request::old('mobile_number1')){ // or if data exist from privious request
                                                                                                                                            echo Request::old('mobile_number1');} ?>" 
                                                                                                                                    placeholder="Type Your 1'st Mobile/Cell Number Here.."  maxlength="12"/>
                    </div>
                </div>
            </div>

            <!--Mobile Number-2-->

            <div class="form-group row">
                <label for="mobile_number2" class="col-md-4 control-label">Mobile/Cell Phone Number-2: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                        <input type="number" class="form-control" name="mobile_number2" id="mobile_number2" maxlength="12" value="<?php if(isset($chamber->mobile_number2)){ //check if chamber data set or blank
                                                                                                                                            echo ($chamber->mobile_number2);} 
                                                                                                                                        elseif(Request::old('mobile_number2')){ // or if data exist from privious request
                                                                                                                                            echo Request::old('mobile_number2');} ?>" 
                                                                                                                                    placeholder="Type 2'nd Mobile/Cell Phone Number Here.."  maxlength="12"/>
                    </div>
                </div>
            </div>

            <!--Mobile Number-3-->

            <div class="form-group row">
                <label for="mobile_number3" class="col-md-4 control-label">Mobile/Cell Phone Number-3: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                        <input type="number" class="form-control" name="mobile_number3" id="mobile_number3" maxlength="12" value="<?php if(isset($chamber->mobile_number3)){  //check if chamber data set or blank
                                                                                                                                            echo ($chamber->mobile_number3);} 
                                                                                                                                        elseif(Request::old('mobile_number3')){ // or if data exist from privious request
                                                                                                                                            echo Request::old('mobile_number3');} ?>"  
                                                                                                                                    placeholder="Type 3'rd Mobile/Cell Phone Number Here.." maxlength="12"/>
                    </div>
                </div>
            </div>

            <!--City Name-->

            <div class="form-group row">
                <label for="city" class="col-md-4 control-label">City: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                        <input type="text" class="form-control" name="city" id="city" maxlength="50" value="<?php if(isset($chamber->city)){ //check if chamber data set or blank
                                                                                                                        echo ($chamber->city);} 
                                                                                                                  elseif(Request::old('city')){ // or if data exist from privious request
                                                                                                                        echo Request::old('city');} ?>" 
                                                                                                                placeholder="Type City Name Here.." />
                    </div>
                </div>
            </div>

            <!--Post Code-->

            <div class="form-group row">
                <label for="post_code" class="col-md-4 control-label">Post/Zip Code: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input type="text" class="form-control" name="post_code" id="post_code" maxlength="10" value="<?php if(isset($chamber->post_code)){ //check if chamber data set or blank
                                                                                                                                echo ($chamber->post_code);} 
                                                                                                                            elseif(Request::old('post_code')){ // or if data exist from privious request
                                                                                                                                echo Request::old('post_code');} ?>"  
                                                                                                                        placeholder="Type Post/Zip Code Here.." maxlength="10"/>
                    </div>
                </div>
            </div>


            <!--Thana Name-->

            <div class="form-group row">
                <label for="thana" class="col-md-4 control-label">Thana(Police Station)/Sub-District Name: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                        <input type="text" class="form-control" name="thana" id="thana" maxlength="50" value="<?php if(isset($chamber->thana)){ //check if chamber data set or blank
                                                                                                                        echo ($chamber->thana);} 
                                                                                                                    elseif(Request::old('thana')){ // or if data exist from privious request
                                                                                                                        echo Request::old('thana');} ?>" 
                                                                                                                placeholder="Type Thana(Police Station) Here.." maxlength="50"/>
                    </div>
                </div>
            </div>


            <!--District Name-->

            <div class="form-group row">
                <label for="district" class="col-md-4 control-label">District Name: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                        <input type="text" class="form-control" name="district" id="district" maxlength="50" value="<?php if(isset($chamber->district)){ //check if chamber data set or blank
                                                                                                                        echo ($chamber->district);} 
                                                                                                                    elseif(Request::old('district')){ // or if data exist from privious request
                                                                                                                        echo Request::old('district');} ?>"
                                                                                                                        placeholder="District Name Here.." maxlength="50"/>
                    </div>
                </div>
            </div>


            <!--Address-->

            <div class="form-group row">
                <label for="address" class="col-md-4 control-label">Address: </label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                        <textarea class="form-control" id="address" name="address" rows="" maxlength="100" placeholder="Type Your Address Here.." maxlength="100"> <?php if(isset($chamber->address)){ //check if chamber data set or blank
                                                                                                                                                                            echo ($chamber->address);} 
                                                                                                                                                                         elseif(Request::old('address')){ // or if data exist from privious request
                                                                                                                                                                            echo Request::old('address');} ?></textarea>
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
                    <a href="/admin/settings/chamber"><button type="button" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-stop"></span> Cancel</button></a>
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