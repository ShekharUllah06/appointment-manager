@extends('layouts.doctor')

@section('title', 'Specialties Page')
@section('description', 'This is the Specialties Page')

@section('content')  
<div class="container-fluid">
        <div class="row">                
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Specialties Page
                </li>
            </ol>
                @include('notifications.status_message')
                @include('notifications.errors_message')           
        </div>

    <div class="row" style="border:0px"> 
        
<!--Starting the Specialty Add Form--->
        <form action="{{url('doctor/settings/specialties/save')}}" method="post" class="form-horizontal " role="form">
            <fieldset>
<!--Specialty-->
                <div class="form-group row" style="border:0px">
                    <label for="specialty" class="col-sm-2 control-label">Specialty Name: </label>
                    <div class="col-sm-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-certificate"></i></span>
                            <input type="specialty" class="form-control" id="specialty" name="specialty" maxlength="50" value="<?php if(isset($specialty->specialty)){  //check if education data set or blank
                                                                                                                                                echo ($specialty->specialty);}
                                                                                                                                                elseif(Request::old('specialty')){ // or if data exist from privious request
                                                                                                                                                echo Request::old('specialty');} ?>" />
                        </div>
                    </div>

<!--Submit Button-->
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-md btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Add</button>
                    </div>
                </div>
            <div class="col-md-4"></div>
            </fieldset>
            {{ csrf_field() }}
        </form>

    </div>

    <!--Specialty List Section-->
    <div class="row" style="border:0px">
            
            <div class="col-md-10 well">
                <label for="specialty">Specialties: </label>
                <div class="inputGroupContainer" id="specialty">
                    <div class="input-group">
                        <ul class="list-inline" id="specialties" name="specialties">
                        @foreach($specialties as $specialty)
                        <!--Specialty Items-->
                        <li class="list-group-item">
                                <label>
                                    &nbsp;&nbsp;
                                    <?php if(isset($specialty->specialty)){  //check if education data set or blank
                                            echo ($specialty->specialty);}
                                            elseif(Request::old('specialty')){ // or if data exist from privious request
                                            echo Request::old('specialty');} ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                </label>
                            
                                <!--Specialty item remove button-->
                                <a href="{{ url('doctor/settings/specialties/remove', ['specialtyName' => $specialty->specialty])}}"><button type="button" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></button></a>
                            </li>
                        @endforeach
                        </ul>

                    </div>
                </div>
                     

            </div>

        </div>
    
</div>
@endsection