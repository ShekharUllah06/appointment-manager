@extends('layouts.doctor')
@section('title', 'Account Settings Page')
@section('description', 'Change Name, Email, Password')

@section('content')
 <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"> Account Settings</i>
        </li>
    </ol>
        @include('notifications.status_message')
        @include('notifications.errors_message') 
        
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <form action="{{ url('doctor/account/information') }}" method="post" class="form-horizontal well" role="form">
                <input type="hidden" id="userId" name="userId" value="{{ $userInfo->id }}" />
                <legend>Information</legend>
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="firstName">First Name: </label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" name="firstName" id="firstName" type="text"  value="{{ $userInfo->first_name }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="firstName">Last Name: </label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" name="lastName" type="text"  value="{{ $userInfo->last_name }}" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="firstName">E-mail: </label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" name="email" type="email"   value="{{ $userInfo->email }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="change">                                
                        <div class="col-md-4"></div>
               
                        <div class="col-md-2" style="margin: 3px; padding: 3px;">
                            <button type="submit" class="btn btn-success btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Change</button>
                        </div>                             
                    </div>
                </fieldset>
                {{ csrf_field() }}
            </form>
            
            
            <form action="{{ url('doctor/account/password') }}" method="post" class="form-horizontal well" role="form">
                <input type="hidden" id="userId" name="formType" value="{{ $userInfo['id'] }}" />
                <legend>Password</legend>
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="currentPassword">Current Password: </label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" name="currentPassword" id="currentPassword" type="password" required/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="newPassword">New Password: </label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" name="newPassword" id="newPassword" type="password" required/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="reNewPassword">New Password Again: </label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" name="reNewPassword" id="reNewPassword" type="password" required/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="change">                                
                        <div class="col-md-4"></div>
               
                        <div class="col-md-2" style="margin: 3px; padding: 3px;">
                            <button type="submit" class="btn btn-success btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Change</button>
                        </div>                             
                    </div>
                </fieldset>
                {{ csrf_field() }}
            </form>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>

@endsection

@section('jscript')

@endsection