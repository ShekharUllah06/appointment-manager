@extends('layouts.patient')
@section('title', 'Patient Account Settings Page')
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
            <!-- main section -->
            <form action="{{url('patient/account/saveInfo')}}" method="post" class="form-horizontal well" role="form">
                <input type="hidden" id="userId" name="userId" value="{{Auth::user()->id}}" maxlength="10"/>
                <legend>Information</legend>
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="firstName">First Name: </label>
                        <div class="col-md-6 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" name="firstName" id="firstName" type="text"  value="{{ $userInfo->first_name }}" maxlength="25" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="firstName">Last Name: </label>
                        <div class="col-md-6 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" name="lastName" type="text"  value="{{ $userInfo->last_name }}" maxlength="25" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="firstName">E-mail: </label>
                        <div class="col-md-6 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" name="email" type="email"   value="{{ $userInfo->email }}" maxlength="60"/>
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


            <form action="{{url('patient/account/savePassword')}}" method="post" class="form-horizontal well" role="form">
                <input type="hidden" id="userId" name="userId" value="{{Auth::user()->id}}"  maxlength="10"/>
                <legend>Password</legend>
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="currentPassword">Current Password: </label>
                        <div class="col-md-6 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" name="currentPassword" id="currentPassword" type="password" required/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="newPassword">New Password: </label>
                        <div class="col-md-6 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" name="newPassword" id="newPassword" type="password" required maxlength="35"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="reNewPassword">Confirm New Password: </label>
                        <div class="col-md-6 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" name="reNewPassword" id="reNewPassword" type="password" required maxlength="35"/>
                            </div>
                        </div>
                        <span class="col-md-3" id="message" style="margine-top: 10px;"></span>
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
<script>
  $("#reNewPassword").keyup(function(){
      if($('#newPassword').val() == $('#reNewPassword').val()){
          $('#message').html('<i class="glyphicon glyphicon-ok"> </i>').css('color', 'green');
      }else{
          $('#message').html('<i class="glyphicon glyphicon-remove"></i> Typed in ne passwords does not match!').css('color', 'red');
      }
  });
</script>
@endsection
